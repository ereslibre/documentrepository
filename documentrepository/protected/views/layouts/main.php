<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

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
				array('label'=>'Create Document', 'url'=>array('document/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Create Character', 'url'=>array('character/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Create Institution', 'url'=>array('institution/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Create Event', 'url'=>array('event/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Create Position', 'url'=>array('position/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Create Language', 'url'=>array('language/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Users', 'url'=>array('/user/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
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

</div><!-- page -->

</body>
</html>