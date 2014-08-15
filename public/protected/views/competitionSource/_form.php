<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'competition-source-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'competition_id', CHtml::listData(Competition::model()->findAll(), 'id', 'name'),array('class'=>'span8','empty'=>'--- Select ---')); ?>

	<?php echo $form->textFieldRow($model,'url',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'order',array('class'=>'span1')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
