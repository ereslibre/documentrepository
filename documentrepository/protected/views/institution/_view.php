<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/css/file_upload-min.css');
    $cs->registerCssFile($baseUrl . '/css/institution-min.css');
?>

<div class="view">

    <div class="image">
        <?php echo CHtml::link(CHtml::image($data->image, $data->name, array('class' => 'thumb')), $data->image, array('target' => '_blank')); ?>
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
    </div>

</div>
