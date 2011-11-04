<?php
$this->breadcrumbs=array(
	Yii::t('languages', 'Languages'),
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('languages', 'Create Language'), 'url'=>array('create')),
	    array('label'=>Yii::t('languages', 'Manage Languages'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('languages', 'Languages') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
