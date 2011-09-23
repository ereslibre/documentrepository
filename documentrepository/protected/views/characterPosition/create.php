<?php
$this->breadcrumbs=array(
	'Character Positions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CharacterPosition', 'url'=>array('index')),
	array('label'=>'Manage CharacterPosition', 'url'=>array('admin')),
);
?>

<h1>Create CharacterPosition</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>