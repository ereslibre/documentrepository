<?php
$this->breadcrumbs=array(
	Yii::t('languages', 'Languages')=>array('index'),
	$model->language,
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('languages', 'List Languages'), 'url'=>array('index')),
	    array('label'=>Yii::t('languages', 'Create Language'), 'url'=>array('create')),
	    array('label'=>Yii::t('languages', 'Update Language'), 'url'=>array('update', 'id'=>$model->id)),
	    array('label'=>Yii::t('languages', 'Delete Language'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app', 'Are you sure?'))),
	    array('label'=>Yii::t('languages', 'Manage Languages'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('languages', 'View Language') ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'language',
	),
)); ?>
