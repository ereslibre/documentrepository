<?php
$this->breadcrumbs=array(
	'Collectives'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Collective', 'url'=>array('index')),
	array('label'=>'Manage Collective', 'url'=>array('admin')),
);
?>

<h1>Create Collective</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>