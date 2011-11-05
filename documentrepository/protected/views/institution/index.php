<?php
$this->breadcrumbs=array(
	Yii::t('institutions', 'Institutions'),
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('institutions', 'Create Institution'), 'url'=>array('create')),
	    array('label'=>Yii::t('institutions', 'Manage Institutions'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('institutions', 'Institutions') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewindex',
)); ?>
