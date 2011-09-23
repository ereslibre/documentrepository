<?php
$this->breadcrumbs=array(
	'Document Characters',
);

$this->menu=array(
	array('label'=>'Create DocumentCharacter', 'url'=>array('create')),
	array('label'=>'Manage DocumentCharacter', 'url'=>array('admin')),
);
?>

<h1>Document Characters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
