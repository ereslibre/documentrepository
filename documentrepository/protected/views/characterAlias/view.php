<?php
$this->breadcrumbs=array(
	'Character Aliases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CharacterAlias', 'url'=>array('index')),
	array('label'=>'Create CharacterAlias', 'url'=>array('create')),
	array('label'=>'Update CharacterAlias', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CharacterAlias', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CharacterAlias', 'url'=>array('admin')),
);
?>

<h1>View CharacterAlias #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'character_id',
		'alias',
	),
)); ?>
