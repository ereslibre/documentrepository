<?php
$this->breadcrumbs=array(
	Yii::t('characters', 'Characters')=>array('index'),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('characters', 'List Characters'), 'url'=>array('index')),
	array('label'=>Yii::t('characters', 'Manage Characters'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('characters', 'Create Character') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'aliases'=>$aliases, 'positions'=>$positions)); ?>
