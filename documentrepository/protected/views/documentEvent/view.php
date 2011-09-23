<?php
$this->breadcrumbs=array(
	'Document Events'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DocumentEvent', 'url'=>array('index')),
	array('label'=>'Create DocumentEvent', 'url'=>array('create')),
	array('label'=>'Update DocumentEvent', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentEvent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentEvent', 'url'=>array('admin')),
);
?>

<h1>View DocumentEvent #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'document_id',
		'event_id',
	),
)); ?>
