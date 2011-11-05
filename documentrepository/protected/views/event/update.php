<?php
$this->breadcrumbs=array(
	Yii::t('events', 'Events')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('events', 'List Events'), 'url'=>array('index')),
	array('label'=>Yii::t('events', 'Create Event'), 'url'=>array('create')),
	array('label'=>Yii::t('events', 'View Event'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('events', 'Manage Events'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('events', 'Update Event'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
