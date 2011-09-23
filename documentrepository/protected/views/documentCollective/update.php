<?php
$this->breadcrumbs=array(
	'Document Collectives'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DocumentCollective', 'url'=>array('index')),
	array('label'=>'Create DocumentCollective', 'url'=>array('create')),
	array('label'=>'View DocumentCollective', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentCollective', 'url'=>array('admin')),
);
?>

<h1>Update DocumentCollective <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>