<?php
$this->breadcrumbs=array(
	'Clubs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Club','url'=>array('index')),
	array('label'=>'Create Club','url'=>array('create')),
	array('label'=>'Update Club','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Club','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Club','url'=>array('admin')),
);
?>

<h1>View Club #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'manager',
		'date_created',
		'date_modified',
	),
)); ?>
