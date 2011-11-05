<?php
$this->breadcrumbs=array(
	Yii::t('languages', 'Languages')=>array('index'),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('languages', 'List Languages'), 'url'=>array('index')),
	array('label'=>Yii::t('languages', 'Manage Languages'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('languages', 'Create Language') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
