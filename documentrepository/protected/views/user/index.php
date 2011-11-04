<?php
$this->breadcrumbs=array(
	Yii::t('users', 'Users'),
);

$this->menu=array(
	array('label'=>Yii::t('users', 'Create User'), 'url'=>array('create')),
	array('label'=>Yii::t('users', 'Manage Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('users', 'Users') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
