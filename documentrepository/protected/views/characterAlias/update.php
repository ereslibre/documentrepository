<?php
$this->breadcrumbs=array(
	'Character Aliases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CharacterAlias', 'url'=>array('index')),
	array('label'=>'Create CharacterAlias', 'url'=>array('create')),
	array('label'=>'View CharacterAlias', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CharacterAlias', 'url'=>array('admin')),
);
?>

<h1>Update CharacterAlias <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>