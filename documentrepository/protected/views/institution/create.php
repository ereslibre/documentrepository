<?php
$this->breadcrumbs=array(
	Yii::t('institutions', 'Institutions')=>array('index'),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('institutions', 'List Institutions'), 'url'=>array('index')),
	array('label'=>Yii::t('institutions', 'Manage Institutions'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('institutions', 'Create Institution') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
