<?php
$this->breadcrumbs=array(
	'Collectives'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Collective', 'url'=>array('index')),
	array('label'=>'Create Collective', 'url'=>array('create')),
	array('label'=>'View Collective', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Collective', 'url'=>array('admin')),
);
?>

<h1>Update Collective <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>