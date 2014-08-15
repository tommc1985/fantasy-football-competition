<?php
$this->breadcrumbs=array(
	'Ties'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tie','url'=>array('index')),
	array('label'=>'Create Tie','url'=>array('create')),
	array('label'=>'View Tie','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Tie','url'=>array('admin')),
);
?>

<h1>Update Tie <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>