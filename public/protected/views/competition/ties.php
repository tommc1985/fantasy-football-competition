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

<h1>Competition Matches</h1>

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

<h2>Matches</h2>

<?php
if (count($model->rounds)) { ?>
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'rounds-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<?php
	if (isset($model->rounds[0]) && !$model->rounds[0]->ties) {
		$tournamentStructure = new KnockoutTournamentStructure(count($model->registrations));
		$tournamentStructure->displayStructureForm($model->id, true);
	} ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Create Matches',
		)); ?>
	</div>

	<?php $this->endWidget(); ?>
<?php
	if ($model->rounds[0]->ties) {
		echo '<p>Matches have been generated</p>';
	}
} else {
	echo '<p>Please create the rounds first</p>';
} ?>