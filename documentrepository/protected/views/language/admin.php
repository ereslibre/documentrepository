<?php
$this->breadcrumbs=array(
	Yii::t('languages', 'Languages')=>array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('languages', 'List Languages'), 'url'=>array('index')),
	array('label'=>Yii::t('languages', 'Create Language'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('language-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('languages', 'Manage Languages') ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'language-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'language',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
