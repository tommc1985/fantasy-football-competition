<?php
$this->breadcrumbs=array(
	'Club Registrations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ClubRegistration','url'=>array('index')),
	array('label'=>'Create ClubRegistration','url'=>array('create')),
	array('label'=>'Update ClubRegistration','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ClubRegistration','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClubRegistration','url'=>array('admin')),
);
?>

<h1>View ClubRegistration #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'club_id',
		'competition_id',
		'identifier',
		'date_created',
		'date_modified',
	),
)); ?>
