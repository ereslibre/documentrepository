<?php
$this->breadcrumbs=array(
	'Document Collectives'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DocumentCollective', 'url'=>array('index')),
	array('label'=>'Manage DocumentCollective', 'url'=>array('admin')),
);
?>

<h1>Create DocumentCollective</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>