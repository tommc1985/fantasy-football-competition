<?php
$this->breadcrumbs=array(
	'Competition Registrations',
);

$this->menu=array(
	array('label'=>'Create Competition Registration','url'=>array('create')),
	array('label'=>'Manage Competition Registration','url'=>array('admin')),
);
?>

<h1>Competition Registrations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
