<?php
$this->breadcrumbs=array(
	'Matches'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Match','url'=>array('index')),
	array('label'=>'Create Match','url'=>array('create')),
	array('label'=>'Update Match','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Match','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Match','url'=>array('admin')),
);
?>

<h1>View Match #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tie_id',
		'home_club_id',
		'away_club_id',
		'name',
		'home_club_points',
		'away_club_points',
		'home_club_tie_breaker',
		'away_club_tie_breaker',
		'start_datetime',
		'finish_datetime',
		'leg_number',
		'replay',
		'status',
		'date_created',
		'date_modified',
		'deleted',
	),
)); ?>
