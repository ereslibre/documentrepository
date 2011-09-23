<?php
$this->breadcrumbs=array(
	'Document Events'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DocumentEvent', 'url'=>array('index')),
	array('label'=>'Create DocumentEvent', 'url'=>array('create')),
	array('label'=>'View DocumentEvent', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentEvent', 'url'=>array('admin')),
);
?>

<h1>Update DocumentEvent <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>