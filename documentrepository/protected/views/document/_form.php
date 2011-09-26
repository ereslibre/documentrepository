<?php
	Yii::app()->clientScript->registerCoreScript('jquery');
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl . '/js/document.js');
	$cs->registerCssFile($baseUrl . '/css/document.css');
	if ($model->id || isset($_POST['Document'])) {
		$cs->registerScriptFile($baseUrl . '/js/document_update.js');
	} else {
		$cs->registerScriptFile($baseUrl . '/js/document_create.js');
	}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'document'); ?>
		<?php echo $form->fileField($model,'document',array('size'=>60)); ?>
		<?php echo $form->error($model,'document'); ?>
		<div id="preview"></div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce',
							array('name' => 'Document[description]',
							'value' => $model->description)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<label>Characters</label>
		<div style="display: none">
			<?php echo CHtml::activeDropDownList(Character::model(), 'id', CHtml::listData(Character::model()->findAll(), 'id', 'name'), array('name'   => 'characters',
																																			   'prompt' => 'Select Character...')); ?>
		</div>
		<div id="selectedcharacters">
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	<?php if (!empty($characters)) { ?>
		current_characters = (<?php echo json_encode($characters) ?>);
	<?php } ?>
</script>