<?php

class LanguageApiController extends ApiController
{
	public function actionChange()
	{
		parse_str(file_get_contents('php://input'), $language);
		$language = array_keys($language);
		$language = $language[0];
		$language = CJSON::decode($language);
		Yii::app()->request->cookies['language'] = new CHttpCookie('language', $language);
		$this->_sendResponse(200, CJSON::encode($language));
	}
}
