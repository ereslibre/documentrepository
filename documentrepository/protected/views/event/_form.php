<?php
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl . '/js/event.js');
	$cssCoreUrl = $cs->getCoreScriptUrl();
	$cs->registerCssFile($cssCoreUrl . '/jui/css/base/jquery-ui.css');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce',
							array('name' => 'Event[description]',
							'value' => $model->description)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?php echo $form->textField($model,'end_date'); ?>
		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->