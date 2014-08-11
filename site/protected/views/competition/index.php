<?php
$this->breadcrumbs=array(
	'Competitions',
);

$this->menu=array(
	array('label'=>'Create Competition','url'=>array('create')),
	array('label'=>'Manage Competition','url'=>array('admin')),
);
?>

<h1>Competitions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
