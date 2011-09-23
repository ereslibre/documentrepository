<?php
$this->breadcrumbs=array(
	'Characters'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Character', 'url'=>array('index')),
	array('label'=>'Create Character', 'url'=>array('create')),
	array('label'=>'View Character', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Character', 'url'=>array('admin')),
);
?>

<h1>Update Character <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>