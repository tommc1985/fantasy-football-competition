<?php
$this->breadcrumbs=array(
	'Rounds'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Round','url'=>array('index')),
	array('label'=>'Create Round','url'=>array('create')),
	array('label'=>'Update Round','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Round','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Round','url'=>array('admin')),
);
?>

<h1>View Round #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'competition_id',
		'name',
		'start_datetime',
		'finish_datetime',
		'legs',
		'replay',
		'tie_breaker',
		'order',
		'date_created',
		'date_modified',
		'deleted',
	),
)); ?>
