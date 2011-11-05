<?php

class DocumentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','update', 'admin','delete'),
				'users'=>array('@'),
			),
			array('deny',
				  'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Document;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$characters = Array();
		$institutions = Array();
		$events = Array();

		if(isset($_POST['Document']))
		{
			$model->attributes=$_POST['Document'];
			$document = CUploadedFile::getInstance($model, 'document');
			if ($document) {
				$documentRepository = Yii::app()->params->documentRepository;
				$model->document = sha1_file($document->getTempName());
			}
			if($model->save()) {
				if ($document) {
					// Save document on filesystem
					$document->saveAs("$documentRepository/{$model->document}");
				}
				// Create characters
				$characters = $this->identifyCharacters($_POST['Document']);
				foreach ($characters as $character) {
					$this->createDocumentCharacter($character, $model->id);
				}
				// Create institutions
				$institutions = $this->identifyInstitutions($_POST['Document']);
				foreach ($institutions as $institution) {
					$this->createDocumentInstitution($institution, $model->id);
				}
				$events = $this->identifyEvents($_POST['Document']);
				foreach ($events as $event) {
					$this->createDocumentEvent($event, $model->id);
				}
				// Everything OK. Redirect
				Yii::app()->user->setFlash('success', Yii::t('documents', 'Document saved correctly'));
				$this->redirect(array('view','id'=>$model->id));
			} else {
				$characters = $this->identifyCharacters($_POST['Document']);
				$institutions = $this->identifyInstitutions($_POST['Document']);
				$events = $this->identifyEvents($_POST['Document']);
			}
			$model->document = $document;
			Yii::app()->user->setFlash('error', Yii::t('documents', 'Document could not be saved. Please review the information you provided'));
		}

		$this->render('create',array(
			'model'        => $model,
			'characters'   => $characters,
			'institutions' => $institutions,
			'events'       => $events
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Document']))
		{
			$oldDocument = $model->document;
			$model->attributes=$_POST['Document'];
			$document = CUploadedFile::getInstance($model, 'document');
			if ($document) {
				$documentRepository = Yii::app()->params->documentRepository;
				$model->document = sha1_file($document->getTempName());
			} else {
				$model->document = $oldDocument;
			}
			if($model->save()) {
				if ($document) {
					// Save document on filesystem
					$document->saveAs("$documentRepository/{$model->document}");
				}

				$characters = $this->identifyCharacters($_POST['Document']);
				$institutions = $this->identifyInstitutions($_POST['Document']);
				$events = $this->identifyEvents($_POST['Document']);

				// Characters
				{
					// Check what characters to remove
					$dbCharacters = DocumentCharacter::model()->findAll(array('select'    => 'character_id',
																			'condition' => 'document_id = :document_id',
																			'params'    => array(':document_id' => $model->id)));
					foreach ($dbCharacters as $character) {
						if (!in_array($character->character_id, $characters)) {
							$this->removeDocumentCharacter($character->character_id, $model->id);
						}
					}

					// Check what characters to add
					foreach ($characters as $character) {
						$exists = DocumentCharacter::model()->exists('character_id = :character_id and document_id = :document_id',
																		array(':character_id' => $character,
																			  ':document_id'  => $model->id));
						if (!$exists) {
							$this->createDocumentCharacter($character, $model->id);
						}
					}
				}

				// Institutions
				{
					// Check what institutions to remove
					$dbInstitutions = DocumentInstitution::model()->findAll(array('select'    => 'institution_id',
																				  'condition' => 'document_id = :document_id',
																				  'params'    => array(':document_id' => $model->id)));
					foreach ($dbInstitutions as $institution) {
						if (!in_array($institution->institution_id, $institutions)) {
							$this->removeDocumentInstitution($institution->institution_id, $model->id);
						}
					}

					// Check what institutions to add
					foreach ($institutions as $institution) {
						$exists = DocumentInstitution::model()->exists('institution_id = :institution_id and document_id = :document_id',
																		array(':institution_id' => $institution,
																			  ':document_id'  => $model->id));
						if (!$exists) {
							$this->createDocumentInstitution($institution, $model->id);
						}
					}
				}

				// Events
				{
					// Check what events to remove
					$dbEvents = DocumentEvent::model()->findAll(array('select'    => 'event_id',
																	  'condition' => 'document_id = :document_id',
																	  'params'    => array(':document_id' => $model->id)));
					foreach ($dbEvents as $event) {
						if (!in_array($event->event_id, $events)) {
							$this->removeDocumentEvent($event->event_id, $model->id);
						}
					}

					// Check what events to add
					foreach ($events as $event) {
						$exists = DocumentEvent::model()->exists('event_id = :event_id and document_id = :document_id',
																	array(':event_id' => $event,
																		  ':document_id'  => $model->id));
						if (!$exists) {
							$this->createDocumentEvent($event, $model->id);
						}
					}
				}
				Yii::app()->user->setFlash('success', Yii::t('documents', 'Document saved correctly'));
				$this->redirect(array('view','id'=>$model->id));
			} else {
				$characters = $this->identifyCharacters($_POST['Document']);
				$institutions = $this->identifyInstitutions($_POST['Document']);
				$events = $this->identifyEvents($_POST['Document']);
			}
			$model->document = $document;
			Yii::app()->user->setFlash('error', Yii::t('documents', 'Document could not be saved. Please review the information you provided'));
		} else {
			$characters_ = DocumentCharacter::model()->findAll(array('select'    => 'character_id',
																	'condition' => 'document_id = :document_id',
																	'params'    => array(':document_id' => $model->id)));
			$characters = Array();
			foreach ($characters_ as &$character) {
				$characters[] = $character->character_id;
			}

			$institutions_ = DocumentInstitution::model()->findAll(array('select'    => 'institution_id',
																		 'condition' => 'document_id = :document_id',
																		 'params'    => array(':document_id' => $model->id)));
			$institutions = Array();
			foreach ($institutions_ as &$institution) {
				$institutions[] = $institution->institution_id;
			}

			$events_ = DocumentEvent::model()->findAll(array('select'    => 'event_id',
															 'condition' => 'document_id = :document_id',
															 'params'    => array(':document_id' => $model->id)));
			$events = Array();
			foreach ($events_ as &$event) {
				$events[] = $event->event_id;
			}
		}

		$this->render('update',array(
			'model'        => $model,
			'characters'   => $characters,
			'institutions' => $institutions,
			'events'       => $events
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Document');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Document('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Document']))
			$model->attributes=$_GET['Document'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Document::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='document-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	private function identifyCharacters($attributes) {
		$characters = Array();
		foreach ($attributes as $attribute => &$value) {
			if (preg_match('/character\d+/', $attribute)) {
				if (empty($value)) {
					continue;
				}
				$characters[] = $value;
			}
		}
		return $characters;
	}

	private function identifyInstitutions($attributes) {
		$institutions = Array();
		foreach ($attributes as $attribute => &$value) {
			if (preg_match('/institution\d+/', $attribute)) {
				if (empty($value)) {
					continue;
				}
				$institutions[] = $value;
			}
		}
		return $institutions;
	}

	private function identifyEvents($attributes) {
		$events = Array();
		foreach ($attributes as $attribute => &$value) {
			if (preg_match('/event\d+/', $attribute)) {
				if (empty($value)) {
					continue;
				}
				$events[] = $value;
			}
		}
		return $events;
	}

	private function createDocumentCharacter($character_id, $document_id)
	{
		$documentCharacter = new DocumentCharacter;
		$documentCharacter->attributes = array('character_id' => $character_id,
											   'document_id'  => $document_id);
		$documentCharacter->save();
	}

	private function removeDocumentCharacter($character_id, $document_id)
	{
		$documentCharacter = DocumentCharacter::model()->find(array('select'    => '*',
																	'condition' => 'character_id = :character_id and document_id = :document_id',
																	'params'    => array(':character_id' => $character_id,
																						 ':document_id'  => $document_id)));
		$documentCharacter->delete();
	}

	private function createDocumentInstitution($institution_id, $document_id)
	{
		$documentInstitution = new DocumentInstitution;
		$documentInstitution->attributes = array('institution_id' => $institution_id,
											    'document_id'   => $document_id);
		$documentInstitution->save();
	}

	private function removeDocumentInstitution($institution_id, $document_id)
	{
		$documentInstitution = DocumentInstitution::model()->find(array('select'    => '*',
																		'condition' => 'institution_id = :institution_id and document_id = :document_id',
																		'params'    => array(':institution_id' => $institution_id,
																							 ':document_id'    => $document_id)));
		$documentInstitution->delete();
	}

	private function createDocumentEvent($event_id, $document_id)
	{
		$documentEvent = new DocumentEvent;
		$documentEvent->attributes = array('event_id'    => $event_id,
										   'document_id' => $document_id);
		$documentEvent->save();
	}

	private function removeDocumentEvent($event_id, $document_id)
	{
		$documentEvent = DocumentEvent::model()->find(array('select'    => '*',
															'condition' => 'event_id = :event_id and document_id = :document_id',
															'params'    => array(':event_id'    => $event_id,
																				 ':document_id' => $document_id)));
		$documentEvent->delete();
	}

    // View helpers

    public function getLanguage($language_id)
    {
        $language = Language::model()->findByPk($language_id);
        if (empty($language)) {
            return echo Yii::t('app', 'Unknown');
        }
        return $language->language;
    }

    public function getRelatedCharacters($document_id)
    {
        $documentCharacters = DocumentCharacter::model()->findAll(array('select'    => 'character_id',
                                                                        'condition' => 'document_id = :document_id',
                                                                        'params'    => array(':document_id' => $document_id)));
        $res = Array();
        if (empty($documentCharacters)) {
            return $res;
        }
        foreach ($documentCharacters as &$documentCharacter) {
            $character = Character::model()->findByPk($documentCharacter->character_id);
            $res[] = Array('id'   => $character->id,
                           'name' => $character->name);
        }
        return $res;
    }

    public function getRelatedInstitutions($document_id)
    {
        $documentInstitutions = DocumentInstitution::model()->findAll(array('select'    => 'institution_id',
                                                                            'condition' => 'document_id = :document_id',
                                                                            'params'    => array(':document_id' => $document_id)));
        $res = Array();
        if (empty($documentInstitutions)) {
            return $res;
        }
        foreach ($documentInstitutions as &$documentInstitution) {
            $institution = Institution::model()->findByPk($documentInstitution->institution_id);
            $res[] = Array('id'   => $institution->id,
                           'name' => $institution->name);
        }
        return $res;
    }

    public function getRelatedEvents($document_id)
    {
        $documentEvents = DocumentEvent::model()->findAll(array('select'    => 'event_id',
                                                                'condition' => 'document_id = :document_id',
                                                                'params'    => array(':document_id' => $document_id)));
        $res = Array();
        if (empty($documentEvents)) {
            return $res;
        }
        foreach ($documentEvents as &$documentEvent) {
            $event = Event::model()->findByPk($documentEvent->event_id);
            $res[] = Array('id'   => $event->id,
                           'name' => $event->name);
        }
        return $res;
    }

    public function printCharacters($data)
    {
        $characters = $this->getRelatedCharacters($data->id);
        if (empty($characters)) {
            echo Yii::t('app', 'None') . '<br/>';
            return;
        }
        echo "<ul>";
        foreach ($characters as &$character) {
            $character_url = $this->createUrl("character/view", array('id' => $character['id']));
            echo "<li>" . CHtml::link($character['name'], $character_url) . "</li>";
        }
        echo "</ul>";
    }

    public function printInstitutions($data)
    {
        $institutions = $this->getRelatedInstitutions($data->id);
        if (empty($institutions)) {
            echo Yii::t('app', 'None') . '<br/>';
            return;
        }
        echo "<ul>";
        foreach ($institutions as &$institution) {
            $institution_url = $this->createUrl("institution/view", array('id' => $institution['id']));
            echo "<li>" . CHtml::link($institution['name'], $institution_url) . "</li>";
        }
        echo "</ul>";
    }

    public function printEvents($data)
    {
        $events = $this->getRelatedEvents($data->id);
        if (empty($events)) {
            echo Yii::t('app', 'None') . '<br/>';
            return;
        }
        echo "<ul>";
        foreach ($events as &$event) {
            $event_url = $this->createUrl("event/view", array('id' => $event['id']));
            echo "<li>" . CHtml::link($event['name'], $event_url) . "</li>";
        }
        echo "</ul>";
    }
}
