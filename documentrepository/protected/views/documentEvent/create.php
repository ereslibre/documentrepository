<?php
$this->breadcrumbs=array(
	'Document Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DocumentEvent', 'url'=>array('index')),
	array('label'=>'Manage DocumentEvent', 'url'=>array('admin')),
);
?>

<h1>Create DocumentEvent</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>