<?php
$this->breadcrumbs=array(
	'Matches'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Match','url'=>array('index')),
	array('label'=>'Create Match','url'=>array('create')),
	array('label'=>'View Match','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Match','url'=>array('admin')),
);
?>

<h1>Update Match <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>