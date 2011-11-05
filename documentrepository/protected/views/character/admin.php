<?php
$this->breadcrumbs=array(
	Yii::t('characters', 'Characters')=>array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('characters', 'List Characters'), 'url'=>array('index')),
	array('label'=>Yii::t('characters', 'Create Character'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('character-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('characters', 'Manage Characters') ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'character-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
