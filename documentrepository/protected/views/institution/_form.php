<?php
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl . '/js/file_upload-min.js');
	$cs->registerScriptFile($baseUrl . '/js/institution-min.js');
	$cs->registerCssFile($baseUrl . '/css/file_upload-min.css');
	$cs->registerCssFile($baseUrl . '/css/institution-min.css');
	$cssCoreUrl = $cs->getCoreScriptUrl();
	$cs->registerCssFile($cssCoreUrl . '/jui/css/base/jquery-ui.css');
	require_once 'protected/views/layouts/translations_shared.php';
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'institution-form',
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
		<?php echo $form->labelEx($model,'description'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce',
							array('name' => 'Institution[description]',
								  'value' => $model->description,
								  'language' => Yii::app()->getLanguage())); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php
			if ($model->id) {
				$baseUrl = Yii::app()->request->baseUrl;
				echo CHtml::label(Yii::t('app', 'Current image'), 'currentimage');
				echo CHtml::image($model->image, '', array('id' => 'currentimage'));
				echo CHtml::label(Yii::t('app', 'Change image'), 'image');
			}
			echo $form->fileField($model,'image');
		?>
		<?php echo $form->error($model,'image'); ?>
		<div id="preview"></div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
