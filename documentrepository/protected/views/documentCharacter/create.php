<?php
$this->breadcrumbs=array(
	'Document Characters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DocumentCharacter', 'url'=>array('index')),
	array('label'=>'Manage DocumentCharacter', 'url'=>array('admin')),
);
?>

<h1>Create DocumentCharacter</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>