<?php
$this->breadcrumbs=array(
	Yii::t('documents', 'Documents'),
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('documents', 'Create Document'), 'url'=>array('create')),
	    array('label'=>Yii::t('documents', 'Manage Documents'), 'url'=>array('admin')),
    );
}
?>

<h1><?php echo Yii::t('documents', 'Documents'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewindex',
)); ?>
