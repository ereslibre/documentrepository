<?php
$this->breadcrumbs=array(
	Yii::t('documents', 'Documents')=>array('index'),
	$model->name,
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('documents', 'List Documents'), 'url'=>array('index')),
	    array('label'=>Yii::t('documents', 'Create Document'), 'url'=>array('create')),
	    array('label'=>Yii::t('documents', 'Update Document'), 'url'=>array('update', 'id'=>$model->id)),
	    array('label'=>Yii::t('documents', 'Delete Document'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app', 'Are you sure?'))),
	    array('label'=>Yii::t('documents', 'Manage Documents'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('documents', 'View Document'); ?></h1>

<?php echo $this->renderPartial('_view', array('data'=>$model,)); ?>
