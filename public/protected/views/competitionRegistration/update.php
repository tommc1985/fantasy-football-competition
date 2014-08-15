<?php
$this->breadcrumbs=array(
	'Competition Registrations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Competition Registration','url'=>array('index')),
	array('label'=>'Create Competition Registration','url'=>array('create')),
	array('label'=>'View Competition Registration','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Competition Registration','url'=>array('admin')),
);
?>

<h1>Update Competition Registration <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>