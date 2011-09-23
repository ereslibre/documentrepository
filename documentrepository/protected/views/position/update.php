<?php
$this->breadcrumbs=array(
	'Positions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Position', 'url'=>array('index')),
	array('label'=>'Create Position', 'url'=>array('create')),
	array('label'=>'View Position', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Position', 'url'=>array('admin')),
);
?>

<h1>Update Position <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>