<?php
$this->breadcrumbs=array(
	'Document Collectives',
);

$this->menu=array(
	array('label'=>'Create DocumentCollective', 'url'=>array('create')),
	array('label'=>'Manage DocumentCollective', 'url'=>array('admin')),
);
?>

<h1>Document Collectives</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
