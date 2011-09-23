<?php
$this->breadcrumbs=array(
	'Document Characters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DocumentCharacter', 'url'=>array('index')),
	array('label'=>'Create DocumentCharacter', 'url'=>array('create')),
	array('label'=>'View DocumentCharacter', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentCharacter', 'url'=>array('admin')),
);
?>

<h1>Update DocumentCharacter <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>