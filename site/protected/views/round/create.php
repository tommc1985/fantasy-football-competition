<?php
$this->breadcrumbs=array(
	'Rounds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Round','url'=>array('index')),
	array('label'=>'Manage Round','url'=>array('admin')),
);
?>

<h1>Create Round</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>