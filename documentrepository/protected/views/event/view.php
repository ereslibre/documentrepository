<?php
$this->breadcrumbs=array(
	Yii::t('events', 'Events')=>array('index'),
	$model->name,
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('events', 'List Events'), 'url'=>array('index')),
	    array('label'=>Yii::t('events', 'Create Event'), 'url'=>array('create')),
	    array('label'=>Yii::t('events', 'Update Event'), 'url'=>array('update', 'id'=>$model->id)),
	    array('label'=>Yii::t('events', 'Delete Event'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app', 'Are you sure?'))),
	    array('label'=>Yii::t('events', 'Manage Events'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('events', 'View Event') ?></h1>

<?php echo $this->renderPartial('_view', array('data'=>$model,)); ?>
