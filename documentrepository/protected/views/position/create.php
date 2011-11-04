<?php
$this->breadcrumbs=array(
	Yii::t('positions', 'Positions')=>array('index'),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>Yii::t('positions', 'List Positions'), 'url'=>array('index')),
	array('label'=>Yii::t('positions', 'Manage Positions'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('positions', 'Create Position') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
