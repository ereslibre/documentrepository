<?php
$this->pageTitle=Yii::app()->name . ' - Search';
$this->breadcrumbs=array(
	Yii::t('app', 'Search'),
);
?>

<div class="form" style="text-align: center">

<form method="POST" action="/index.php/search/search">

	<div class="row">
		<?php echo CHtml::label(Yii::t('app', 'Search'), 'search'); ?>
		<?php echo CHtml::textField('search','',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('appaction', 'Search')); ?>
	</div>

</form>

</div><!-- form -->
