<?php
$this->breadcrumbs=array(
	Yii::t('characters', 'Characters')=>array('index'),
	$model->name,
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('characters', 'List Characters'), 'url'=>array('index')),
	    array('label'=>Yii::t('characters', 'Create Character'), 'url'=>array('create')),
	    array('label'=>Yii::t('characters', 'Update Character'), 'url'=>array('update', 'id'=>$model->id)),
	    array('label'=>Yii::t('characters', 'Delete Character'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app', 'Are you sure?'))),
	    array('label'=>Yii::t('characters', 'Manage Characters'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('characters', 'View Character') ?></h1>

<?php echo $this->renderPartial('_view', array('data'=>$model,)); ?>
