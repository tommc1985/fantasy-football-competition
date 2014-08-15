<?php
$this->breadcrumbs=array(
	'Ties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tie','url'=>array('index')),
	array('label'=>'Manage Tie','url'=>array('admin')),
);
?>

<h1>Create Tie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>