<?php
$this->breadcrumbs=array(
	'Ties'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Tie','url'=>array('index')),
	array('label'=>'Create Tie','url'=>array('create')),
	array('label'=>'Update Tie','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Tie','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tie','url'=>array('admin')),
);
?>

<h1>View Tie #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'round_id',
		'home_tie_id',
		'away_tie_id',
		'home_club_id',
		'away_club_id',
		'name',
		'home_club_points',
		'away_club_points',
		'home_club_tie_breaker',
		'away_club_tie_breaker',
		'start_datetime',
		'finish_datetime',
		'type',
		'status',
		'date_modified',
		'date_created',
		'deleted',
	),
)); ?>
