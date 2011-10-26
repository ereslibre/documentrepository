<?php

class CharacterApiController extends ApiController
{
	public function actionList()
	{
		$result = array();
		$characters = Character::model()->findAll();
		foreach ($characters as &$character) {
			$result[] = array('id'   => $character->id,
							  'name' => $character->name);
		}
		$this->_sendResponse(200, CJSON::encode($result));
	}
}
