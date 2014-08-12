<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'round_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'home_tie_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'away_tie_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'home_club_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'away_club_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'home_club_points',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'away_club_points',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'home_club_tie_breaker',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'away_club_tie_breaker',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'start_datetime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'finish_datetime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'date_modified',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date_created',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
