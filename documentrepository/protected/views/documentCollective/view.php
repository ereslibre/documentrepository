<?php
$this->breadcrumbs=array(
	'Document Collectives'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DocumentCollective', 'url'=>array('index')),
	array('label'=>'Create DocumentCollective', 'url'=>array('create')),
	array('label'=>'Update DocumentCollective', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentCollective', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentCollective', 'url'=>array('admin')),
);
?>

<h1>View DocumentCollective #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'document_id',
		'collective_id',
	),
)); ?>
