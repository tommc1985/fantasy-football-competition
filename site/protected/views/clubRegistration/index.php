<?php
$this->breadcrumbs=array(
	'Club Registrations',
);

$this->menu=array(
	array('label'=>'Create ClubRegistration','url'=>array('create')),
	array('label'=>'Manage ClubRegistration','url'=>array('admin')),
);
?>

<h1>Club Registrations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
