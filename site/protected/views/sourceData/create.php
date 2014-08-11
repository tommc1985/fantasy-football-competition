<?php
$this->breadcrumbs=array(
	'Source Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SourceData','url'=>array('index')),
	array('label'=>'Manage SourceData','url'=>array('admin')),
);
?>

<h1>Create SourceData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>