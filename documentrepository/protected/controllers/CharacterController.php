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
		$model=new Character;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Character']))
		{
			$model->attributes=$_POST['Character'];
			$image = CUploadedFile::getInstance($model, 'image');
			if ($image) {
				$documentRepository = Yii::app()->params->documentRepository;
				$model->image = sha1_file($image->getTempName());
			}
			if($model->save()) {
				// Save image on filesystem
				$image->saveAs("$documentRepository/{$model->image}");
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
				$this->redirect(array('view','id'=>$model->id));
			}
			$model->image = $image;
		}

		$this->render('create',array(
			'model'=>$model,
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

				$this->redirect(array('view','id'=>$model->id));
			} else {
				$aliases = $this->identifyAliases($_POST['Character']);
				$positions = $this->identifyPositions($_POST['Character']);
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
		$characterPosition->attributes = array('position_id'  => $position['position'],
											   'start_date'   => $position['from'],
											   'end_date'     => $position['to'],
											   'character_id' => $character_id);
		$characterPosition->save();
	}

	private function removeCharacterPosition($position, $character_id)
	{
		$characterPosition = CharacterPosition::model()->find(array('select'    => '*',
																	'condition' => 'position_id = :position_id and start_date = :start_date and end_date = :end_date and character_id = :character_id',
																	'params'    => array(':position_id'  => $position['position'],
																						 ':start_date'   => $position['from'],
																						 ':end_date'     => $position['to'],
																						 ':character_id' => $character_id)));
		$characterPosition->delete();
	}
}
