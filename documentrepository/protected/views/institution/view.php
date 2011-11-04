<?php
$this->breadcrumbs=array(
	Yii::t('institutions', 'Institutions')=>array('index'),
	$model->name,
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('institutions', 'List Institutions'), 'url'=>array('index')),
	    array('label'=>Yii::t('institutions', 'Create Institution'), 'url'=>array('create')),
	    array('label'=>Yii::t('institutions', 'Update Institution'), 'url'=>array('update', 'id'=>$model->id)),
	    array('label'=>Yii::t('institutions', 'Delete Institution'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app', 'Are you sure?'))),
	    array('label'=>Yii::t('institutions', 'Manage Institutions'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('institutions', 'View Institution') ?></h1>

<?php echo $this->renderPartial('_view', array('data'=>$model,)); ?>
