<?php
$this->breadcrumbs=array(
	Yii::t('positions', 'Positions'),
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('positions', 'Create Position'), 'url'=>array('create')),
	    array('label'=>Yii::t('positions', 'Manage Positions'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('positions', 'Positions') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
