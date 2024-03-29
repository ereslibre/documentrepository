<?php $this->pageTitle=Yii::app()->name; ?>

<?php
$this->breadcrumbs=array(
	Yii::t('documents', 'Documents'),
);

if (Yii::app()->user->isGuest) {
	$this->menu=array(
		array('label'=>Yii::t('documents', 'List Documents'), 'url'=>array('document/index')),
		array('label'=>Yii::t('characters', 'List Characters'), 'url'=>array('character/index')),
		array('label'=>Yii::t('institutions', 'List Institutions'), 'url'=>array('institution/index')),
		array('label'=>Yii::t('events', 'List Events'), 'url'=>array('event/index')),
		array('label'=>Yii::t('positions', 'List Positions'), 'url'=>array('position/index')),
		array('label'=>Yii::t('languages', 'List Languages'), 'url'=>array('language/index')),
	);
} else {
	$this->menu=array(
		array('label'=>Yii::t('documents', 'Manage Documents'), 'url'=>array('document/admin')),
		array('label'=>Yii::t('characters', 'Manage Characters'), 'url'=>array('character/admin')),
		array('label'=>Yii::t('institutions', 'Manage Institutions'), 'url'=>array('institution/admin')),
		array('label'=>Yii::t('events', 'Manage Events'), 'url'=>array('event/admin')),
		array('label'=>Yii::t('positions', 'Manage Positions'), 'url'=>array('position/admin')),
		array('label'=>Yii::t('languages', 'Manage Languages'), 'url'=>array('language/admin')),
	);
}
?>

<?php echo $this->renderPartial('_search'); ?>
