<?php
$this->breadcrumbs=array(
	'Character Positions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CharacterPosition', 'url'=>array('index')),
	array('label'=>'Create CharacterPosition', 'url'=>array('create')),
	array('label'=>'Update CharacterPosition', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CharacterPosition', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CharacterPosition', 'url'=>array('admin')),
);
?>

<h1>View CharacterPosition #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'character_id',
		'position_id',
		'start_date',
		'end_date',
	),
)); ?>
