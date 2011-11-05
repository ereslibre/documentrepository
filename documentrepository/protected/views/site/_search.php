<?php
$this->pageTitle=Yii::app()->name . ' - Search';
$this->breadcrumbs=array(
	'Search',
);
?>

<div class="form" style="text-align: center">

<form method="POST" action="/index.php/search/search">

	<div class="row">
		<?php echo CHtml::label('Search', 'search'); ?>
		<?php echo CHtml::textField('search','',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

</form>

</div><!-- form -->
