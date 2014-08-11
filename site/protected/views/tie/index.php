<?php
$this->breadcrumbs=array(
	'Ties',
);

$this->menu=array(
	array('label'=>'Create Tie','url'=>array('create')),
	array('label'=>'Manage Tie','url'=>array('admin')),
);
?>

<h1>Ties</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
