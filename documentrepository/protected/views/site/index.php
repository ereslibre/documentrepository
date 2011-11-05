<?php $this->pageTitle=Yii::app()->name; ?>

<?php
$this->breadcrumbs=array(
	Yii::t('documents', 'Documents'),
);

$this->menu=array(
	array('label'=>Yii::t('documents', 'List Documents'), 'url'=>array('document/index')),
	array('label'=>Yii::t('characters', 'List Characters'), 'url'=>array('character/index')),
	array('label'=>Yii::t('institutions', 'List Institutions'), 'url'=>array('institution/index')),
	array('label'=>Yii::t('events', 'List Events'), 'url'=>array('event/index')),
	array('label'=>Yii::t('positions', 'List Positions'), 'url'=>array('position/index')),
	array('label'=>Yii::t('languages', 'List Languages'), 'url'=>array('language/index')),
);
?>

<?php echo $this->renderPartial('_search'); ?>
