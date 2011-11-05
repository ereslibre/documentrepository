<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/css/file_upload-min.css');
    $cs->registerCssFile($baseUrl . '/css/institution-min.css');

    $institution_url = $this->createUrl("institution/view", array('id' => $data->id));
?>

<div class="view">

    <div class="image">
        <?php echo CHtml::image($data->image, $data->name, array('class' => 'thumb')); ?>
    </div>

    <div class="description">
	    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	    <?php echo CHtml::encode($data->name); ?>
    </div>

    <div class="readmore">
        <?php echo CHtml::link(Yii::t('app', 'Read more'), $institution_url) ?>
    </div>
</div>
