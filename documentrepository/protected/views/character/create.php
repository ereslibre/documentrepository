<?php
$this->breadcrumbs=array(
	'Characters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Character', 'url'=>array('index')),
	array('label'=>'Manage Character', 'url'=>array('admin')),
);
?>

<h1>Create Character</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>