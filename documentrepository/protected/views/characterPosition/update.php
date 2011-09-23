<?php
$this->breadcrumbs=array(
	'Character Positions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CharacterPosition', 'url'=>array('index')),
	array('label'=>'Create CharacterPosition', 'url'=>array('create')),
	array('label'=>'View CharacterPosition', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CharacterPosition', 'url'=>array('admin')),
);
?>

<h1>Update CharacterPosition <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>