<?php
$this->breadcrumbs=array(
	'Character Aliases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CharacterAlias', 'url'=>array('index')),
	array('label'=>'Manage CharacterAlias', 'url'=>array('admin')),
);
?>

<h1>Create CharacterAlias</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>