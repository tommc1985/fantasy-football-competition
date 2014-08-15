<?php
$this->breadcrumbs=array(
	'Rounds',
);

$this->menu=array(
	array('label'=>'Create Round','url'=>array('create')),
	array('label'=>'Manage Round','url'=>array('admin')),
);
?>

<h1>Rounds</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
