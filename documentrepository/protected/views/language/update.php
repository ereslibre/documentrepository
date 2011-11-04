<?php
$this->breadcrumbs=array(
	Yii::t('languages', 'Languages')=>array('index'),
	$model->language=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('languages', 'List Languages'), 'url'=>array('index')),
	array('label'=>Yii::t('languages', 'Create Language'), 'url'=>array('create')),
	array('label'=>Yii::t('languages', 'View Language'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('languages', 'Manage Languages'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('languages', 'Update Language') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
