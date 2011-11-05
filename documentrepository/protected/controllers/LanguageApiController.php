<?php

class LanguageApiController extends ApiController
{
	public function actionChange()
	{
		parse_str(file_get_contents('php://input'), $language);
		$language = array_keys($language);
		$language = $language[0];
		$language = CJSON::decode($language);
		$languageCookie = new CHttpCookie('language', $language);
		$languageCookie->expire = time() + 31104000; // a year
		Yii::app()->request->cookies['language'] = $languageCookie;
		$this->_sendResponse(200, CJSON::encode($language));
	}
}
