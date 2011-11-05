<?php
	$this->beginContent('//layouts/main');
	$hasMenu = !empty($this->menu);
	$contentClass = $hasMenu ? "span-19" : "span-24 last";
?>
<div class="container">
	<div class="<?php echo $contentClass ?>">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
<?php if ($hasMenu) { ?>
	<div class="span-5 last">
		<div id="sidebar">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>Yii::t('app', 'Operations'),
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		?>
		</div><!-- sidebar -->
	</div>
<?php } ?>
</div>
<?php $this->endContent(); ?>
