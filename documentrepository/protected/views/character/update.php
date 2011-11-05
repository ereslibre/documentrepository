<?php
$this->breadcrumbs=array(
	Yii::t('characters', 'Characters')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('characters', 'List Characters'), 'url'=>array('index')),
	array('label'=>Yii::t('characters', 'Create Character'), 'url'=>array('create')),
	array('label'=>Yii::t('characters', 'View Character'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('characters', 'Manage Characters'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('characters', 'Update Character') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'aliases'=>$aliases, 'positions'=>$positions)); ?>
