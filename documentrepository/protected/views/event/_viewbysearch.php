<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/css/file_upload-min.css');
    $cs->registerCssFile($baseUrl . '/css/event-min.css');
?>

<div class="view">

    <div class="image">
        <?php echo CHtml::link(CHtml::image($data->image, $data->name, array('class' => 'thumb')), $data->image, array('target' => '_blank')); ?>
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

<a href="javascript:void(0);" onclick="javascript:history.go(-1);"><?php echo Yii::t('app', 'Back to search results') ?></a>