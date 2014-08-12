<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'competition_id', CHtml::listData(Competition::model()->findAll(), 'id', 'name'),array('class'=>'span8','empty'=>'--- Select ---')); ?>

	<?php echo $form->dropDownListRow($model,'club_id', CHtml::listData(Club::model()->findAll(), 'id', 'name'),array('class'=>'span8','empty'=>'--- Select ---')); ?>

	<?php echo $form->textFieldRow($model,'identifier',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'date_created',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date_modified',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
