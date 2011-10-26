<?php

class EventApiController extends ApiController
{
	public function actionList()
	{
		$result = array();
		$events = Event::model()->findAll();
		foreach ($events as &$event) {
			$result[] = array('id'   => $event->id,
							  'name' => $event->name);
		}
		$this->_sendResponse(200, CJSON::encode($result));
	}
}
