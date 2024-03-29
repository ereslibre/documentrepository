<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/css/file_upload-min.css');
    $cs->registerCssFile($baseUrl . '/css/character-min.css');
	require_once 'translations.php';

    $character_url = $this->createUrl("character/view", array('id' => $data->id));
?>

<div class="view">

    <div class="image">
        <?php echo CHtml::link(CHtml::image($data->image, $data->name, array('class' => 'thumb')), $data->image, array('target' => '_blank')); ?>
    </div>

    <div class="description">
	    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	    <?php echo CHtml::encode($data->name); ?>
	    <br />
        <b><?php echo Yii::t('characters', 'Aliases') ?>:</b>
        <?php $this->printAliases($data); ?>
	    <b><?php echo CHtml::encode($data->getAttributeLabel('birth_date')); ?>:</b>
	    <?php echo CHtml::encode($data->birth_date); ?>
	    <br />
	    <b><?php echo CHtml::encode($data->getAttributeLabel('death_date')); ?>:</b>
	    <?php echo CHtml::encode($data->death_date); ?>
        <br />
        <b><?php echo Yii::t('positions', 'Positions') ?>:</b>
        <?php $this->printPositions($data); ?>
    </div>

    <div class="readmore">
        <?php echo CHtml::link(Yii::t('app', 'Read more'), $character_url) ?>
    </div>
</div>

