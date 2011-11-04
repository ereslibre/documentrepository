<?php
$this->breadcrumbs=array(
	Yii::t('institutions', 'Institutions')=>array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('institutions', 'List Institutions'), 'url'=>array('index')),
	array('label'=>Yii::t('institutions', 'Create Institution'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('institution-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('institutions', 'Manage Institutions') ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'institution-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
