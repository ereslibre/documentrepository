<?php
$this->breadcrumbs=array(
	Yii::t('positions', 'Positions')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('positions', 'List Positions'), 'url'=>array('index')),
	array('label'=>Yii::t('positions', 'Create Position'), 'url'=>array('create')),
	array('label'=>Yii::t('positions', 'View Position'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('positions', 'Manage Positions'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('positions', 'Update Position') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
