<?php
$this->breadcrumbs=array(
	'Character Aliases',
);

$this->menu=array(
	array('label'=>'Create CharacterAlias', 'url'=>array('create')),
	array('label'=>'Manage CharacterAlias', 'url'=>array('admin')),
);
?>

<h1>Character Aliases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
