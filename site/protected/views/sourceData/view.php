<?php
$this->breadcrumbs=array(
	'Source Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SourceData','url'=>array('index')),
	array('label'=>'Create SourceData','url'=>array('create')),
	array('label'=>'Update SourceData','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete SourceData','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SourceData','url'=>array('admin')),
);
?>

<h1>View SourceData #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'competition_source_id',
		'url',
		'data',
		'success',
		'date_added',
		'date_modified',
		'deleted',
	),
)); ?>
