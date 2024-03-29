<?php
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl . '/js/file_upload-min.js');
	$cs->registerScriptFile($baseUrl . '/js/character-min.js');
	$cs->registerCssFile($baseUrl . '/css/file_upload-min.css');
	$cs->registerCssFile($baseUrl . '/css/character-min.css');
	$cssCoreUrl = $cs->getCoreScriptUrl();
	$cs->registerCssFile($cssCoreUrl . '/jui/css/base/jquery-ui.css');
	if ($model->id || isset($_POST['Character'])) {
		$cs->registerScriptFile($baseUrl . '/js/character_update-min.js');
	} else {
		$cs->registerScriptFile($baseUrl . '/js/character_create-min.js');
	}
	require_once 'translations.php';
	require_once 'protected/views/layouts/translations_shared.php';
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'character-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<label><?php echo Yii::t('characters', 'Aliases'); ?></label>
		<div id="addedAlias">
		</div>
		<div id="addAlias">
			<?php echo CHtml::textField('Character[alias0]'); ?>
			<a href="javascript:void(0);" onclick="javascript:addAlias();"><?php echo Yii::t('app', 'Add') ?></a>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birth_date'); ?>
		<?php echo $form->textField($model,'birth_date'); ?>
		<?php echo $form->error($model,'birth_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'death_date'); ?>
		<?php echo $form->textField($model,'death_date'); ?>
		<?php echo $form->error($model,'death_date'); ?>
	</div>

	<div class="row">
		<label><?php echo Yii::t('positions', 'Positions') ?></label>
		<div id="addedPosition">
		</div>
		<div id="addPosition">
			<?php echo Yii::t('app', 'From') ?>: <?php echo $form->textField($model,'from_position0'); ?>
			<?php echo Yii::t('app', 'To') ?>: <?php echo $form->textField($model,'to_position0'); ?>
			<?php echo Yii::t('positions', 'Position') ?>:
			<?php echo CHtml::dropDownList('Character[position0]', '', CHtml::listData(Position::model()->findAll(), 'id', 'name'), array('prompt' => Yii::t('characters', 'Select Position...'), 'onChange' => 'addPosition();')); ?>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'biography'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce',
							array('name'     => 'Character[biography]',
								  'value'    => $model->biography,
								  'language' => Yii::app()->getLanguage())); ?>
		<?php echo $form->error($model,'biography'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<div id="currimage">
			<?php
				if ($model->id) {
					$baseUrl = Yii::app()->request->baseUrl;
					echo CHtml::label(Yii::t('app', 'Current image'), 'currentimage');
					echo CHtml::image($model->image, '', array('id' => 'currentimage'));
					echo CHtml::label(Yii::t('app', 'Change image'), 'image');
				}
				echo $form->fileField($model,'image');
				echo $form->error($model,'image');
			?>
			<div id="preview"></div>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	<?php if (!empty($aliases)) { ?>
		current_aliases = JSON.parse('<?php echo json_encode($aliases) ?>');
	<?php } ?>
	<?php if (!empty($positions)) { ?>
		current_positions = JSON.parse('<?php echo json_encode($positions) ?>');
	<?php } ?>
</script>
