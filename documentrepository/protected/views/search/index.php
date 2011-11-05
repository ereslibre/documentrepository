<?php
$this->breadcrumbs=array(
	Yii::t('search', 'Search Results'),
);

if (!Yii::app()->user->isGuest) {
    $this->menu=array(
	    array('label'=>Yii::t('documents', 'List Documents'), 'url'=>array('document/index')),
	    array('label'=>Yii::t('characters', 'List Characters'), 'url'=>array('character/index')),
    );
}
?>

<h1><?php echo Yii::t('search', 'Search Results') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewindex',
)); ?>
