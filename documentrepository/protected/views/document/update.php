<?php
$this->breadcrumbs=array(
	Yii::t('documents', 'Documents')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('documents', 'List Documents'), 'url'=>array('index')),
	array('label'=>Yii::t('documents', 'Create Document'), 'url'=>array('create')),
	array('label'=>Yii::t('documents', 'View Document'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('documents', 'Manage Documents'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('documents', 'Update Document') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
											   'characters'=>$characters,
											   'institutions'=>$institutions,
											   'events'=>$events)); ?>
