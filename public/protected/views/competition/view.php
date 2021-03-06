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

<h1>View Competition</h1>

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

<?php
switch ($model->status) {
	case 'provisional': ?>
	<h2>Registered Teams</h2>
	<ul>
	<?php
	foreach ($model->registrations as $registration) { ?>
		<li><?php echo CHtml::encode($registration->club->name); ?> (<?php echo CHtml::encode($registration->club->manager); ?>)</li>
	<?php
	} ?>
	</ul>

	<h2>Proposed Rounds</h2>
	<?php
	$tournamentStructure = new KnockoutTournamentStructure(count($model->registrations));
	$tournamentStructure->displayStructure(true);
		break;
	case 'in_progress': ?>
	<h2>Rounds</h2>
		<?php
		KnockoutTournamentStructure::displayMatches($model);
		break;
} ?>

<pre>
<?php //var_dump($tournamentStructure); ?>
</pre>