<?php

class SearchController extends Controller
{
	public function actionSearch()
	{
		$searchText = $_POST['search'];
		if (empty($searchText)) {
			Yii::app()->user->setFlash('error', Yii::t('app', 'Search is empty'));
			$this->redirect('/');
		}
	}
}
