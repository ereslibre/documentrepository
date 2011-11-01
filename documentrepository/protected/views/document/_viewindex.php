<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/css/file_upload-min.css');
    $cs->registerCssFile($baseUrl . '/css/document-min.css');

    $document_url = $this->createUrl("document/view", array('id' => $data->id));
?>

<div class="view">

    <div class="document">
        <?php echo CHtml::image($data->document, $data->name, array('class' => 'thumb')); ?>
    </div>

    <div class="description">
	    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	    <?php echo CHtml::encode($data->name); ?>
	    <br />
	    <b><?php echo CHtml::encode($data->getAttributeLabel('catalog')); ?>:</b>
	    <?php echo CHtml::encode($data->catalog); ?>
	    <br />
	    <b><?php echo CHtml::encode($data->getAttributeLabel('language_id')); ?>:</b>
	    <?php echo CHtml::encode($this->getLanguage($data->language_id)); ?>
	    <br />
	    <b>Related characters:</b>
	    <?php echo $this->printCharacters($data);  ?>
	    <b>Related institutions:</b>
	    <?php echo $this->printInstitutions($data); ?>
	    <b>Related events:</b>
	    <?php echo $this->printEvents($data); ?>
    </div>

    <div class="readmore">
        <?php echo CHtml::link('Read more', $document_url) ?>
    </div>
</div>
