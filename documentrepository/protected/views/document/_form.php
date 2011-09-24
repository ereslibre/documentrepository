<?php
	Yii::app()->clientScript->registerCoreScript('jquery');
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl . '/js/document.js');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'document'); ?>
		<?php echo $form->textField($model,'document',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'document'); ?>
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
		<?php echo $form->labelEx($model,'description'); ?>
		<div style="display: none">
			<?php echo CHtml::activeDropDownList(Character::model(), 'id', CHtml::listData(Character::model()->findAll(), 'id', 'name'), array('name' => 'characters')); ?>
		</div>
		<div id="selectedcharacters">
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
