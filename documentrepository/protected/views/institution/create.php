<?php
$this->breadcrumbs=array(
	'Institutions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Institution', 'url'=>array('index')),
	array('label'=>'Manage Institution', 'url'=>array('admin')),
);
?>

<h1>Create Institution</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>