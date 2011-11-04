<?php
$this->breadcrumbs=array(
	Yii::t('users', 'Users')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('users', 'List Users'), 'url'=>array('index')),
	array('label'=>Yii::t('users', 'Create User'), 'url'=>array('create')),
	array('label'=>Yii::t('users', 'View User'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('users', 'Manage Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('users', 'Update User') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
