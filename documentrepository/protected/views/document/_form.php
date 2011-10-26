<?php
	Yii::app()->clientScript->registerCoreScript('jquery');
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl . '/js/file_upload.js');
	$cs->registerScriptFile($baseUrl . '/js/document.js');
	$cs->registerCssFile($baseUrl . '/css/file_upload.css');
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
		<?php echo $form->labelEx($model,'document'); ?>
		<div id="currimage">
			<?php
				if ($model->id) {
					$baseUrl = Yii::app()->request->baseUrl;
					echo CHtml::label('Current document', 'currentdocument');
					echo CHtml::image("$baseUrl/repository/{$model->document}", '', array('id' => 'currentdocument', 'class' => 'thumb'));
					echo CHtml::label('Change document', 'document');
				}
				echo $form->fileField($model,'document');
			?>
			<?php echo $form->error($model,'document'); ?>
			<div id="preview"></div>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'catalog'); ?>
		<?php echo $form->textField($model,'catalog',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'catalog'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language_id'); ?>
			<?php echo CHtml::activeDropDownList($model, 'language_id', CHtml::listData(Language::model()->findAll(), 'id', 'language'), array('prompt' => 'Select Language...')); ?>
		<?php echo $form->error($model,'language_id'); ?>
	</div>

	<div class="row">
		<label>Characters (<a href="<?php echo "$baseUrl/index.php/character/create" ?>" target=_blank>Create</a> - <a href="javascript:void(0);" onclick="reloadCharacters();">Reload</a>)</label>
		<?php
			if (Character::model()->count() == 0) {
				echo 'No characters found';
			}
		?>
		<div style="display: none">
			<?php echo CHtml::dropDownList('characters', '', CHtml::listData(Character::model()->findAll(), 'id', 'name'), array('prompt' => 'Select Character...')); ?>
		</div>
		<div id="selectedcharacters">
		</div>
	</div>

	<div class="row">
		<label>Institutions (<a href="<?php echo "$baseUrl/index.php/institution/create" ?>" target=_blank>Create</a> - <a href="javascript:void(0);" onclick="reloadInstitutions();">Reload</a>)</label>
		<?php
			if (Institution::model()->count() == 0) {
				echo 'No institutions found';
			}
		?>
		<div style="display: none">
			<?php echo CHtml::dropDownList('institutions', '', CHtml::listData(Institution::model()->findAll(), 'id', 'name'), array('prompt' => 'Select Institution...')); ?>
		</div>
		<div id="selectedinstitutions">
		</div>
	</div>

	<div class="row">
		<label>Events (<a href="<?php echo "$baseUrl/index.php/event/create" ?>" target=_blank>Create</a> - <a href="javascript:void(0);" onclick="reloadEvents();">Reload</a>)</label>
		<?php
			if (Event::model()->count() == 0) {
				echo 'No events found';
			}
		?>
		<div style="display: none">
			<?php echo CHtml::dropDownList('events', '', CHtml::listData(Event::model()->findAll(), 'id', 'name'), array('prompt' => 'Select Event...')); ?>
		</div>
		<div id="selectedevents">
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	<?php if (!empty($characters)) { ?>
		current_characters = JSON.parse('<?php echo json_encode($characters) ?>');
	<?php } ?>
	<?php if (!empty($institutions)) { ?>
		current_institutions = JSON.parse('<?php echo json_encode($institutions) ?>');
	<?php } ?>
	<?php if (!empty($events)) { ?>
		current_events = JSON.parse('<?php echo json_encode($events) ?>');
	<?php } ?>
</script>
