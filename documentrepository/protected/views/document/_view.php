<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/css/file_upload-min.css');
    $cs->registerCssFile($baseUrl . '/css/document.css');
?>

<div class="view">

    <div class="document">
        <?php echo CHtml::image("$baseUrl/repository/{$data->document}", $data->name, array('class' => 'thumb')); ?>
    </div>

    <div class="description">
	    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	    <?php echo CHtml::encode($data->name); ?>
	    <br />
	    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	    <?php echo $data->description; ?>
	    <b><?php echo CHtml::encode($data->getAttributeLabel('catalog')); ?>:</b>
	    <?php echo CHtml::encode($data->catalog); ?>
	    <br />
	    <b><?php echo CHtml::encode($data->getAttributeLabel('language_id')); ?>:</b>
	    <?php echo CHtml::encode($this->getLanguage($data->language_id)); ?>
	    <br />
	    <b>Related characters:</b>
	    <?php echo CHtml::encode(print_r($this->getRelatedCharacters($data->id), true)); ?>
	    <br />
	    <b>Related institutions:</b>
	    <?php echo CHtml::encode(print_r($this->getRelatedInstitutions($data->id), true)); ?>
	    <br />
	    <b>Related events:</b>
	    <?php echo CHtml::encode(print_r($this->getRelatedEvents($data->id), true)); ?>
    </div>

</div>
