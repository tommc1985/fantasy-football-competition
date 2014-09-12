<?php
$this->breadcrumbs=array(
	'Competitions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Competition','url'=>array('index')),
	array('label'=>'Create Competition','url'=>array('create')),
	array('label'=>'Update Competition','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Competition','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Competition','url'=>array('admin')),
	array('label'=>'Rounds in Competition','url'=>array('rounds','id'=>$model->id)),
	array('label'=>'Ties in Competition','url'=>array('ties','id'=>$model->id)),
);
?>

<h1>Competition Rounds</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'slug',
		'type',
		'source',
		'status',
		'date_created',
		'date_modified',
	),
)); ?>

<h2>Rounds</h2>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'rounds-form',
	'enableAjaxValidation'=>false,
)); ?>

<table class="table tabled-bordered table-striped">
	<thead>
		<tr>
			<td><?php echo CHtml::activeLabelEx($model,"name",array('class'=>'span2')); ?></td>
			<td><?php echo CHtml::activeLabelEx($model,"start_datetime",array('class'=>'span2')); ?></td>
			<td><?php echo CHtml::activeLabelEx($model,"finish_datetime",array('class'=>'span2')); ?></td>
			<td><?php echo CHtml::activeLabelEx($model,"two_legged",array('class'=>'span1')); ?></td>
			<td><?php echo CHtml::activeLabelEx($model,"number_of_replays",array('class'=>'span1')); ?></td>
			<td><?php echo CHtml::activeLabelEx($model,"tie_breaker",array('class'=>'span1')); ?></td>
		</tr>
	</thead>
	<tbody>
<?php
$i = 1;
foreach ($rounds as $round) {
	$this->renderPartial('../round/_horizontal_form',array(
		'model'=>$round,
		'form'=>$form,
		'roundNumber'=>$i,
	));
	$i++;
} ?>
	</tbody>
</table>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Save',
	)); ?>
</div>

<?php $this->endWidget(); ?>