<?php
$this->breadcrumbs=array(
	'Collectives'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Collective', 'url'=>array('index')),
	array('label'=>'Create Collective', 'url'=>array('create')),
	array('label'=>'Update Collective', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Collective', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Collective', 'url'=>array('admin')),
);
?>

<h1>View Collective #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'image',
	),
)); ?>
