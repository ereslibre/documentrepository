<?php

class CharacterController extends Controller
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
				'actions'=>array('index','view', 'viewBySearch', 'viewFromDocument'),
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

	public function actionViewBySearch($id)
	{
		$this->render('_viewbysearch',array(
			'data'=>$this->loadModel($id),
		));
	}

	public function actionViewFromDocument($id, $documentId)
	{
		$this->render('_viewfromdocument',array(
			'data'=>$this->loadModel($id),
			'document'=>$this->loadDocumentModel($documentId)
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Character;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$aliases = Array();
		$positions = Array();

		if(isset($_POST['Character']))
		{
			$model->attributes=$_POST['Character'];
			$image = CUploadedFile::getInstance($model, 'image');
			if ($image) {
				$documentRepository = Yii::app()->params->documentRepository;
				$model->image = sha1_file($image->getTempName());
			}
			if($model->save()) {
				if ($image) {
					// Save image on filesystem
					$image->saveAs("$documentRepository/{$model->image}");
				}
				// Create aliases
				$aliases = $this->identifyAliases($_POST['Character']);
				foreach ($aliases as $alias) {
					$this->createCharacterAlias($alias, $model->id);
				}
				// Create positions
				$positions = $this->identifyPositions($_POST['Character']);
				foreach ($positions as $position) {
					$this->createCharacterPosition($position, $model->id);
				}
				// Everything OK. Redirect
				Yii::app()->user->setFlash('success', Yii::t('characters', 'Character saved correctly'));
				$this->redirect(array('view','id'=>$model->id));
			} else {
				$aliases = $this->identifyAliases($_POST['Character']);
				$positions = $this->identifyPositions($_POST['Character']);
			}
			$model->image = $image;
			Yii::app()->user->setFlash('error', Yii::t('characters', 'Character could not be saved. Please review the information you provided'));
		}

		$this->render('create',array(
			'model'=>$model,
			'aliases'=>$aliases,
			'positions'=>$positions
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

		if(isset($_POST['Character']))
		{
			$oldImage = $model->image;
			$model->attributes=$_POST['Character'];
			$image = CUploadedFile::getInstance($model, 'image');
			if ($image) {
				$documentRepository = Yii::app()->params->documentRepository;
				$model->image = sha1_file($image->getTempName());
			} else {
				$model->image = $oldImage;
			}
			if($model->save()) {
				// Save image on filesystem
				if ($image) {
					$image->saveAs("$documentRepository/{$model->image}");
				}

				$aliases = $this->identifyAliases($_POST['Character']);
				$positions = $this->identifyPositions($_POST['Character']);

				// Aliases
				{
					// Check what aliases to remove
					$dbAliases = CharacterAlias::model()->findAll(array('select'    => 'alias',
																		'condition' => 'character_id = :character_id',
																		'params'    => array(':character_id' => $model->id)));
					foreach ($dbAliases as $alias) {
						if (!in_array($alias->alias, $aliases)) {
							$this->removeCharacterAlias($alias->alias, $model->id);
						}
					}

					// Check what aliases to add
					foreach ($aliases as $alias) {
						$exists = CharacterAlias::model()->exists('alias = :alias and character_id = :character_id',
																		array(':alias' => $alias,
																			  ':character_id'  => $model->id));
						if (!$exists) {
							$this->createCharacterAlias($alias, $model->id);
						}
					}
				}

				// Positions
				{
					// Check what positions to remove
					$dbPositions = CharacterPosition::model()->findAll(array('select'    => 'position_id, start_date, end_date',
																			 'condition' => 'character_id = :character_id',
																			 'params'    => array(':character_id' => $model->id)));
					foreach ($dbPositions as $position) {
						$position_ = Position::model()->findByPk($position->position_id);
						$thisPosition = Array('position_id'   => $position->position_id,
											  'position_name' => $position_->name,
											  'start_date'    => $position->start_date,
											  'end_date'      => $position->end_date);
						if (!in_array($thisPosition, $positions)) {
							$this->removeCharacterPosition($thisPosition, $model->id);
						}
					}

					// Check what positions to add
					foreach ($positions as $position) {
						$fromDate = DateTime::createFromFormat('d/m/Y', $position['start_date']);
						$toDate = DateTime::createFromFormat('d/m/Y', $position['end_date']);
						$exists = CharacterPosition::model()->exists('position_id = :position_id and start_date = :start_date and end_date = :end_date and character_id = :character_id',
																		array(':position_id'  => $position['position_id'],
																			  ':start_date'   => date('Y-m-d', $fromDate->getTimestamp()),
																			  ':end_date'     => !empty($toDate) ? date('Y-m-d', $toDate->getTimestamp()) : null,
																			  ':character_id' => $model->id));
						if (!$exists) {
							$thisPosition = Array('position_id' => $position['position_id'],
												  'start_date'  => $position['start_date'],
												  'end_date'    => $position['end_date']);
							$this->createCharacterPosition($thisPosition, $model->id);
						}
					}
				}

				Yii::app()->user->setFlash('success', Yii::t('characters', 'Character saved correctly'));
				$this->redirect(array('view','id'=>$model->id));
			} else {
				$aliases = $this->identifyAliases($_POST['Character']);
				$positions = $this->identifyPositions($_POST['Character']);
				Yii::app()->user->setFlash('error', Yii::t('characters', 'Character could not be saved. Please review the information you provided'));
			}
		} else {
			$aliases_ = CharacterAlias::model()->findAll(array('select'    => 'alias',
															   'condition' => 'character_id = :character_id',
															   'params'    => array(':character_id' => $model->id)));
			$aliases = Array();
			foreach ($aliases_ as &$alias) {
				$aliases[] = $alias->alias;
			}

			$positions_ = CharacterPosition::model()->findAll(array('select'    => 'position_id, start_date, end_date',
																	'condition' => 'character_id = :character_id',
																	'params'    => array(':character_id' => $model->id)));
			$positions = Array();
			foreach ($positions_ as &$position) {
				$position_ = Position::model()->findByPk($position->position_id);
				$positions[] = array('position_id'   => $position->position_id,
									 'position_name' => $position_->name,
									 'start_date'    => $position->start_date,
									 'end_date'      => $position->end_date);
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'aliases'=>$aliases,
			'positions'=>$positions
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
		$dataProvider=new CActiveDataProvider('Character');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Character('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Character']))
			$model->attributes=$_GET['Character'];

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
		$model=Character::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadDocumentModel($id)
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='character-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	private function identifyAliases($attributes)
	{
		$aliases = Array();
		foreach ($attributes as $attribute => &$value) {
			if (preg_match('/alias\d+/', $attribute)) {
				if (empty($value)) {
					continue;
				}
				$aliases[] = $value;
			}
		}
		return $aliases;
	}

	private function identifyPositions($attributes)
	{
		$positions = Array();
		foreach ($attributes as $attribute => &$value) {
			if (preg_match('/^position(\d+)/', $attribute, $matches)) {
				$positionId = $matches[1];
				$fromDate = $attributes["from_position$positionId"];
				if (empty($value) || empty($fromDate)) {
					continue;
				}
				$position = Position::model()->findByPk($value);
				$toDate = $attributes["to_position$positionId"];
                if (empty($toDate) || $toDate == Yii::t('app', 'To present')) {
                    $toDate = null;
                }
				$positions[] = Array('position_id'   => $value,
									 'position_name' => $position->name,
									 'start_date'    => $fromDate,
									 'end_date'      => $toDate);
			}
		}
		return $positions;
	}

	private function createCharacterAlias($alias, $character_id)
	{
		$characterAlias = new CharacterAlias;
		$characterAlias->attributes = array('alias'        => $alias,
											'character_id' => $character_id);
		$characterAlias->save();
	}

	private function removeCharacterAlias($alias, $character_id)
	{
		$characterAlias = CharacterAlias::model()->find(array('select'    => '*',
															  'condition' => 'alias = :alias and character_id = :character_id',
															  'params'    => array(':alias'        => $alias,
																				   ':character_id' => $character_id)));
		$characterAlias->delete();
	}

	private function createCharacterPosition($position, $character_id)
	{
		$characterPosition = new CharacterPosition;
		$characterPosition->attributes = array('position_id'  => $position['position_id'],
											   'start_date'   => $position['start_date'],
											   'end_date'     => $position['end_date'],
											   'character_id' => $character_id);
		$characterPosition->save();
	}

	private function removeCharacterPosition($position, $character_id)
	{
		$fromDate = DateTime::createFromFormat('d/m/Y', $position['start_date']);
		$toDate = DateTime::createFromFormat('d/m/Y', $position['end_date']);
        $conditionToDate = "is null";
        $paramArray = array(':position_id'  => $position['position_id'],
							':start_date'   => date('Y-m-d', $fromDate->getTimestamp()),
							':character_id' => $character_id);
        if (!empty($toDate)) {
            $toDate = date('Y-m-d', $toDate->getTimestamp());
            $conditionToDate = "= :end_date";
            $paramArray[':end_date'] = $toDate;
        }
		$characterPosition = CharacterPosition::model()->find(array('select'    => '*',
																	'condition' => "position_id = :position_id and start_date = :start_date and end_date $conditionToDate and character_id = :character_id",
																	'params'    => $paramArray));
		$characterPosition->delete();
	}

    // View helpers

    public function getRelatedAliases($character_id)
    {
        $characterAliases = CharacterAlias::model()->findAll(array('select'    => 'alias',
                                                                   'condition' => 'character_id = :character_id',
                                                                   'params'    => array(':character_id' => $character_id)));
        $res = Array();
        if (empty($characterAliases)) {
            return $res;
        }
        foreach ($characterAliases as &$characterAlias) {
            $res[] = $characterAlias->alias;
        }
        return $res;
    }

    public function getRelatedPositions($character_id)
    {
        $characterPositions = CharacterPosition::model()->findAll(array('select'    => 'position_id, start_date, end_date',
                                                                        'condition' => 'character_id = :character_id',
                                                                        'params'    => array(':character_id' => $character_id)));
        $res = Array();
        if (empty($characterPositions)) {
            return $res;
        }
        foreach ($characterPositions as &$characterPosition) {
            $position = Position::model()->findByPk($characterPosition->position_id);
            $res[] = Array('id'         => $position->id,
                           'name'       => $position->name,
                           'start_date' => $characterPosition->start_date,
                           'end_date'   => $characterPosition->end_date);
        }
        return $res;
    }

    public function printAliases($data)
    {
        $aliases = $this->getRelatedAliases($data->id);
        if (empty($aliases)) {
            echo Yii::t('app', 'None') . '<br/>';
            return;
        }
        echo "<ul>";
        foreach ($aliases as &$alias) {
            echo "<li>$alias</li>";
        }
        echo "</ul>";
    }

    public function printPositions($data)
    {
        $positions = $this->getRelatedPositions($data->id);
        if (empty($positions)) {
            echo Yii::t('app', 'None') . '<br/>';
            return;
        }
        echo "<ul>";
        foreach ($positions as &$position) {
            $positionName = $position['name'];
            $positionStartDate = $position['start_date'];
            $positionEndDate = $position['end_date'];
            echo "<li>$positionName ($positionStartDate - $positionEndDate)</li>";
        }
        echo "</ul>";
    }
}
