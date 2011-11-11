<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/css/file_upload-min.css');
    $cs->registerCssFile($baseUrl . '/css/document-min.css');
?>

<div class="view">

    <div class="document">
        <?php echo CHtml::link(CHtml::image($data->document, $data->name, array('class' => 'thumb')), $data->document, array('target' => '_blank')); ?>
    </div>

    <div class="description">
	    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	    <?php echo CHtml::encode($data->name); ?>
	    <br />
	    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
		<?php
			if (empty($data->description)) {
				echo Yii::t('app', 'None') . '<br/>';
			} else {
				echo $data->description;
			}
		?>
	    <b><?php echo CHtml::encode($data->getAttributeLabel('catalog')); ?>:</b>
	    <?php echo CHtml::encode($data->catalog); ?>
	    <br />
	    <b><?php echo CHtml::encode($data->getAttributeLabel('language_id')); ?>:</b>
	    <?php echo CHtml::encode($this->getLanguage($data->language_id)); ?>
	    <br />
	    <b><?php echo Yii::t('documents', 'Related characters')?>:</b>
	    <?php echo $this->printCharactersWithBacklink($data);  ?>
	    <b><?php echo Yii::t('documents', 'Related institutions')?>:</b>
	    <?php echo $this->printInstitutionsWithBacklink($data); ?>
	    <b><?php echo Yii::t('documents', 'Related events')?>:</b>
	    <?php echo $this->printEventsWithBacklink($data); ?>
    </div>

</div>

<a href="javascript:void(0);" onclick="javascript:history.go(-1);"><?php echo Yii::t('app', 'Back to search results') ?></a>