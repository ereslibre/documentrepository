<?php
$this->breadcrumbs=array(
	Yii::t('search', 'Search Results'),
);

if (!Yii::app()->user->isGuest) {
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

<h1><?php echo Yii::t('search', 'Search Results') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewindex',
)); ?>
