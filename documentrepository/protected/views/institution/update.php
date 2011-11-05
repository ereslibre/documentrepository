<?php
$this->breadcrumbs=array(
	Yii::t('institutions', 'Institutions')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('institutions', 'List Institutions'), 'url'=>array('index')),
	array('label'=>Yii::t('institutions', 'Create Institution'), 'url'=>array('create')),
	array('label'=>Yii::t('institutions', 'View Institution'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('institutions', 'Manage Institutions'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('institutions', 'Update Institution') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
