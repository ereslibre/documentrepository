<?php
$this->breadcrumbs=array(
	Yii::t('users', 'Users')=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>Yii::t('users', 'List Users'), 'url'=>array('index')),
	array('label'=>Yii::t('users', 'Create User'), 'url'=>array('create')),
	array('label'=>Yii::t('users', 'Update User'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('users', 'Delete User'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app', 'Are you sure?'))),
	array('label'=>Yii::t('users', 'Manage Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('users', 'View User') ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
	),
)); ?>
