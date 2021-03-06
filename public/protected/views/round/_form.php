<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'round-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'parent_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'competition_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'start_datetime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'finish_datetime',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'legs',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'replay',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'tie_breaker',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'order',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
