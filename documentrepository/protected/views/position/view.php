<?php
$this->breadcrumbs=array(
	'Positions'=>array('index'),
	$model->name,
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>'List Position', 'url'=>array('index')),
	    array('label'=>'Create Position', 'url'=>array('create')),
	    array('label'=>'Update Position', 'url'=>array('update', 'id'=>$model->id)),
	    array('label'=>'Delete Position', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	    array('label'=>'Manage Position', 'url'=>array('admin')),
    );
}
?>

<h1>View Position #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
	),
)); ?>
