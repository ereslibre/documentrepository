<?php
	$language = null;
	if (isset(Yii::app()->request->cookies['language'])) {
		$language = Yii::app()->request->cookies['language']->value;
	}
	Yii::app()->session['lang'] = $language;
	Yii::app()->setLanguage($language);

	Yii::app()->clientScript->registerCoreScript('jquery');
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl . '/js/translate-min.js');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen-min.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print-min.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie-min.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main-min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form-min.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><a href="<?php echo Yii::app()->homeUrl ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
// 				array('label'=>'Home', 'url'=>array('/site/index')),
// 				array('label'=>'Search', 'url'=>array('search')),
				array('label'=>Yii::t('t', 'Create Document'), 'url'=>array('document/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('t', 'Create Character'), 'url'=>array('character/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('t', 'Create Institution'), 'url'=>array('institution/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('t', 'Create Event'), 'url'=>array('event/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('t', 'Create Position'), 'url'=>array('position/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('t', 'Create Language'), 'url'=>array('language/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('t', 'Users'), 'url'=>array('/user/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('t', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('t', 'Logout'), 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php if (Yii::app()->user->hasFlash('success')) { ?>
		<div class="flashinfo">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php } ?>

	<?php if (Yii::app()->user->hasFlash('error')) { ?>
		<div class="flasherror">
			<?php echo Yii::app()->user->getFlash('error'); ?>
		</div>
	<?php } ?>

	<?php echo $content; ?>

	<div class="language">
		<a href="javascript:void(0);" onclick="translate('es_ES');"><img src="/images/spanish.png"></a>
		<a href="javascript:void(0);" onclick="translate('en_US');"><img src="/images/english.png"></a>
	</div>

</div><!-- page -->

</body>
</html>
