<?php
$this->breadcrumbs=array(
	'Clubs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Club','url'=>array('index')),
	array('label'=>'Create Club','url'=>array('create')),
	array('label'=>'View Club','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Club','url'=>array('admin')),
);
?>

<h1>Update Club <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>