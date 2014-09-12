<?php
$this->breadcrumbs=array(
	'Matches',
);

$this->menu=array(
	array('label'=>'Create Match','url'=>array('create')),
	array('label'=>'Manage Match','url'=>array('admin')),
);
?>

<h1>Matches</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
