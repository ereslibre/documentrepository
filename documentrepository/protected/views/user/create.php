<?php
$this->breadcrumbs=array(
	Yii::t('users', 'Users')=>array('index'),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('users', 'List Users'), 'url'=>array('index')),
	array('label'=>Yii::t('users', 'Manage User'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('users', 'Create User') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
