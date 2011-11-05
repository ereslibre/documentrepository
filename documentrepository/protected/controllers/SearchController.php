<?php

class SearchController extends DocumentHelperController
{
	public function actionSearch()
	{
		$searchText = isset($_POST['search']) ? $_POST['search'] : null;
		if (empty($searchText)) {
			Yii::app()->user->setFlash('error', Yii::t('app', 'Search is empty'));
			$this->redirect('/');
		}
		$dataProvider=new CActiveDataProvider('Document');
		$this->render('index',array(
			'dataProvider'=>$dataProvider
		));
	}
}
