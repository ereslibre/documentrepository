<?php

class SearchController extends DocumentHelperController
{
	public function actionSearch($searchText)
	{
		if (empty($searchText)) {
			Yii::app()->user->setFlash('error', Yii::t('app', 'Search is empty'));
			$this->redirect('/');
		}
		$dataProvider=new CActiveDataProvider('Document', array(
			'criteria' => array(
				'condition' => "`name` like '%$searchText%'"
			),
			'pagination' => array(
				'pageSize' => 100,
			)
		));
		try {
			if ($dataProvider->getItemCount() === 0) {
				Yii::app()->user->setFlash('error', Yii::t('app', 'No results found'));
				$this->redirect('/');
			} else {
				$this->render('index',array(
					'dataProvider'=>$dataProvider
				));
			}
		} catch (Exception $e) {
			Yii::app()->user->setFlash('error', Yii::t('app', 'Invalid characters in query'));
			$this->redirect('/');
		}
	}
}
