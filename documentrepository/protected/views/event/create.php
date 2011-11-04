<?php
$this->breadcrumbs=array(
	Yii::t('events', 'Events')=>array('index'),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('events', 'List Events'), 'url'=>array('index')),
	array('label'=>Yii::t('events', 'Manage Events'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('events', 'Create Event'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
