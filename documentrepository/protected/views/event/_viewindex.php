<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/css/file_upload-min.css');
    $cs->registerCssFile($baseUrl . '/css/event-min.css');

    $event_url = $this->createUrl("event/view", array('id' => $data->id));
?>

<div class="view">

    <div class="image">
        <?php echo CHtml::image($data->image, $data->name, array('class' => 'thumb')); ?>
    </div>

    <div class="description">
	    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	    <?php echo CHtml::encode($data->name); ?>
	    <br />
	    <b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	    <?php echo CHtml::encode($data->start_date); ?>
	    <br />
	    <b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	    <?php echo CHtml::encode($data->end_date); ?>
    </div>

    <div class="readmore">
        <?php echo CHtml::link('Read more', $event_url) ?>
    </div>
</div>
