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
		$collectives = Array();

		if(isset($_POST['Document']))
		{
			$model->attributes=$_POST['Document'];
			$document = CUploadedFile::getInstance($model, 'document');
			if ($document) {
				$documentRepository = Yii::app()->params->documentRepository;
				$model->document = sha1_file($document->getTempName());
			}
			if($model->save()) {
				// Save document on filesystem
				$document->saveAs("$documentRepository/{$model->document}");
				// Create characters
				$characters = $this->identifyCharacters($_POST['Document']);
				foreach ($characters as $character) {
					$this->createDocumentCharacter($character, $model->id);
				}
				// Create collectives
				$collectives = $this->identifyCollectives($_POST['Document']);
				foreach ($collectives as $collective) {
					$this->createDocumentCollective($collective, $model->id);
				}
				// Everything OK. Redirect
				$this->redirect(array('view','id'=>$model->id));
			} else {
				$characters = $this->identifyCharacters($_POST['Document']);
				$collectives = $this->identifyCollectives($_POST['Document']);
			}
			$model->document = $document;
		}

		$this->render('create',array(
			'model'       => $model,
			'characters'  => $characters,
			'collectives' => $collectives
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

		$characters = Array();
		$collectives = Array();

		if(isset($_POST['Document']))
		{
			$model->attributes=$_POST['Document'];
			if($model->save()) {
				$characters = $this->identifyCharacters($_POST['Document']);
				$collectives = $this->identifyCollectives($_POST['Document']);

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
						$exists = DocumentCharacter::model()->find(array('select'    => '*',
																		'condition' => 'character_id = :character_id and document_id = :document_id',
																		'params'    => array(':character_id' => $character,
																							':document_id'  => $model->id)));
						if (!$exists) {
							$this->createDocumentCharacter($character, $model->id);
						}
					}
				}

				// Collectives
				{
					// Check what collectives to remove
					$dbCollectives = DocumentCollective::model()->findAll(array('select'    => 'collective_id',
																				'condition' => 'document_id = :document_id',
																				'params'    => array(':document_id' => $model->id)));
					foreach ($dbCollectives as $collective) {
						if (!in_array($collective->collective_id, $collectives)) {
							$this->removeDocumentCollective($collective->collective_id, $model->id);
						}
					}

					// Check what collectives to add
					foreach ($collectives as $collective) {
						$exists = DocumentCollective::model()->find(array('select'    => '*',
																		  'condition' => 'collective_id = :collective_id and document_id = :document_id',
																		  'params'    => array(':collective_id' => $collective,
																							   ':document_id'  => $model->id)));
						if (!$exists) {
							$this->createDocumentCollective($collective, $model->id);
						}
					}
				}

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$characters_ = DocumentCharacter::model()->findAll(array('select'    => 'character_id',
																 'condition' => 'document_id = :document_id',
																 'params'    => array(':document_id' => $model->id)));
		$characters = Array();
		foreach ($characters_ as &$character) {
			$characters[] = $character->character_id;
		}

		$collectives_ = DocumentCollective::model()->findAll(array('select'    => 'collective_id',
																   'condition' => 'document_id = :document_id',
																   'params'    => array(':document_id' => $model->id)));
		$collectives = Array();
		foreach ($collectives_ as &$collective) {
			$collectives[] = $collective->collective_id;
		}

		$this->render('update',array(
			'model'       => $model,
			'characters'  => $characters,
			'collectives' => $collectives,
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

	private function identifyCollectives($attributes) {
		$collectives = Array();
		foreach ($attributes as $attribute => &$value) {
			if (preg_match('/collective\d+/', $attribute)) {
				if (empty($value)) {
					continue;
				}
				$collectives[] = $value;
			}
		}
		return $collectives;
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

	private function createDocumentCollective($collective_id, $document_id)
	{
		$documentCollective = new DocumentCollective;
		$documentCollective->attributes = array('collective_id' => $collective_id,
											    'document_id'   => $document_id);
		$documentCollective->save();
	}

	private function removeDocumentCollective($collective_id, $document_id)
	{
		$documentCollective = DocumentCollective::model()->find(array('select'    => '*',
																	  'condition' => 'collective_id = :collective_id and document_id = :document_id',
																	  'params'    => array(':collective_id' => $collective_id,
																						   ':document_id'   => $document_id)));
		$documentCollective->delete();
	}
}
