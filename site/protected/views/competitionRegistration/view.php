<?php
$this->breadcrumbs=array(
	'Competition Registrations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Competition Registration','url'=>array('index')),
	array('label'=>'Create Competition Registration','url'=>array('create')),
	array('label'=>'Update Competition Registration','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Competition Registration','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Competition Registration','url'=>array('admin')),
);
?>

<h1>View Competition Registration #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'competition_id',
		'club_id',
		'identifier',
		'date_created',
		'date_modified',
	),
)); ?>
