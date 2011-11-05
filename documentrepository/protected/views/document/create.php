<?php
$this->breadcrumbs=array(
	Yii::t('documents', 'Documents')=>array('index'),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('documents', 'List Documents'), 'url'=>array('index')),
	array('label'=>Yii::t('documents', 'Manage Documents'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('documents', 'Create Document') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
											   'characters'=>$characters,
											   'institutions'=>$institutions,
											   'events'=>$events)); ?>
