<?php

class InstitutionApiController extends ApiController
{
	public function actionList()
	{
		$result = array();
		$institutions = Institution::model()->findAll();
		foreach ($institutions as &$institution) {
			$result[] = array('id'   => $institution->id,
							  'name' => $institution->name);
		}
		$this->_sendResponse(200, CJSON::encode($result));
	}
}
