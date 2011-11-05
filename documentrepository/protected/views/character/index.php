<?php
$this->breadcrumbs=array(
	Yii::t('characters', 'Characters'),
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('characters', 'Create Character'), 'url'=>array('create')),
	    array('label'=>Yii::t('characters', 'Manage Characters'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('characters', 'Characters') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewindex',
)); ?>
