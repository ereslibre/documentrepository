<?php
$this->breadcrumbs=array(
	Yii::t('positions', 'Positions')=>array('index'),
	$model->name,
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('positions', 'List Positions'), 'url'=>array('index')),
	    array('label'=>Yii::t('positions', 'Create Position'), 'url'=>array('create')),
	    array('label'=>Yii::t('positions', 'Update Position'), 'url'=>array('update', 'id'=>$model->id)),
	    array('label'=>Yii::t('positions', 'Delete Position'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app', 'Are you sure?'))),
	    array('label'=>Yii::t('positions', 'Manage Positions'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('positions', 'View Position')?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
	),
)); ?>
