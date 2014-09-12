<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'match-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'tie_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'home_club_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'away_club_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'home_club_points',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'away_club_points',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'home_club_tie_breaker',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'away_club_tie_breaker',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'start_datetime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'finish_datetime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'leg_number',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'replay',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'date_created',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date_modified',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'deleted',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
