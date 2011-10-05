<?php
$this->breadcrumbs=array(
	'Institutions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Institution', 'url'=>array('index')),
	array('label'=>'Create Institution', 'url'=>array('create')),
	array('label'=>'View Institution', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Institution', 'url'=>array('admin')),
);
?>

<h1>Update Institution <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>