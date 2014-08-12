<?php
$this->breadcrumbs=array(
	'Competition Sources'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CompetitionSource','url'=>array('index')),
	array('label'=>'Create CompetitionSource','url'=>array('create')),
	array('label'=>'Update CompetitionSource','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CompetitionSource','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompetitionSource','url'=>array('admin')),
);
?>

<h1>View CompetitionSource #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'competition_id',
		'url',
		'order',
		'date_created',
		'date_modified',
		'deleted',
	),
)); ?>
