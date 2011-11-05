<?php
$this->breadcrumbs=array(
	'Events',
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('events', 'Create Event'), 'url'=>array('create')),
	    array('label'=>Yii::t('events', 'Manage Events'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('events', 'Events') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewindex',
)); ?>
