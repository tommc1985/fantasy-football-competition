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

<h2>Proposed Rounds</h2>

<?php
$tournamentStructure = new KnockoutTournamentStructure(count($model->registrations));
$tournamentStructure->display(true);

echo '<pre>';
var_dump($tournamentStructure);
echo '</pre>';