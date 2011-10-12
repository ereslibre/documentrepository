<?php
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl . '/js/file_upload.js');
	$cs->registerScriptFile($baseUrl . '/js/character.js');
	$cs->registerCssFile($baseUrl . '/css/file_upload.css');
	$cssCoreUrl = $cs->getCoreScriptUrl();
	$cs->registerCssFile($cssCoreUrl . '/jui/css/base/jquery-ui.css');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'character-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<label>Alias</label>
		<div id="addedAlias">
		</div>
		<div id="addAlias">
			<?php echo CHtml::textField('Character[alias0]'); ?>
			<a href="javascript:void(0);" onclick="javascript:addAlias();">Add</a>
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
		<label>Positions</label>
		<div id="addedPosition">
		</div>
		<div id="addPosition">
			From: <?php echo $form->textField($model,'from_position0'); ?>
			To: <?php echo $form->textField($model,'to_position0'); ?>
			Position:
			<?php echo CHtml::dropDownList('Character[position0]', '', CHtml::listData(Position::model()->findAll(), 'id', 'name'), array('prompt' => 'Select Position...')); ?>
			<a href="javascript:void(0);" onclick="javascript:addPosition();">Add</a>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'biography'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce',
							array('name' => 'Character[biography]',
										'value' => $model->biography)); ?>
		<?php echo $form->error($model,'biography'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php
			if ($model->id) {
				$baseUrl = Yii::app()->request->baseUrl;
				echo CHtml::label('Current image', 'currentimage');
				echo CHtml::image("$baseUrl/repository/{$model->image}", '', array('id' => 'currentimage'));
				echo CHtml::label('Change image', 'image');
			}
			echo $form->fileField($model,'image');
		?>
		<?php echo $form->error($model,'image'); ?>
		<div id="preview"></div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->