<?php
$this->breadcrumbs=array(
	'Source Datas',
);

$this->menu=array(
	array('label'=>'Create SourceData','url'=>array('create')),
	array('label'=>'Manage SourceData','url'=>array('admin')),
);
?>

<h1>Source Datas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
