<?php
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl . '/js/jquery.cookie-min.js');
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

<div id="flags" class="language">
	<a id="es_flag" class="flag" href="javascript:void(0);" onclick="translate('es');"><img class="flag_img" src="/images/spanish.png"></a>
	<a id="en_flag" class="flag" href="javascript:void(0);" onclick="translate('en');"><img class="flag_img" src="/images/english.png"></a>
</div>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><a href="<?php echo Yii::app()->homeUrl ?>"><?php echo Yii::t('app', 'Document Repository') ?></a></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
// 				array('label'=>'Home', 'url'=>array('/site/index')),
// 				array('label'=>'Search', 'url'=>array('search')),
				array('label'=>Yii::t('app', 'Create Document'), 'url'=>array('document/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('app', 'Create Character'), 'url'=>array('character/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('app', 'Create Institution'), 'url'=>array('institution/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('app', 'Create Event'), 'url'=>array('event/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('app', 'Create Position'), 'url'=>array('position/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('app', 'Create Language'), 'url'=>array('language/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('app', 'Users'), 'url'=>array('/user/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('app', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('app', 'Logout'), 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php if (Yii::app()->user->hasFlash('success')) { ?>
		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php } ?>

	<?php if (Yii::app()->user->hasFlash('error')) { ?>
		<div class="flash-error">
			<?php echo Yii::app()->user->getFlash('error'); ?>
		</div>
	<?php } ?>

	<?php echo $content; ?>

</div><!-- page -->

<div style="display: none">
	<div id="language"><?php echo Yii::app()->getLanguage() ?></div>
</div>

</body>
</html>
