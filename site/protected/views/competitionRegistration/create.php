<?php
$this->breadcrumbs=array(
	'Competition Registrations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Competition Registration','url'=>array('index')),
	array('label'=>'Manage Competition Registration','url'=>array('admin')),
);
?>

<h1>Create Competition Registration</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>