<?php
$this->breadcrumbs=array(
	'Document Events',
);

$this->menu=array(
	array('label'=>'Create DocumentEvent', 'url'=>array('create')),
	array('label'=>'Manage DocumentEvent', 'url'=>array('admin')),
);
?>

<h1>Document Events</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
