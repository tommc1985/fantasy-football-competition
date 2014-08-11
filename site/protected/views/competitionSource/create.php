<?php
$this->breadcrumbs=array(
	'Competition Sources'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompetitionSource','url'=>array('index')),
	array('label'=>'Manage CompetitionSource','url'=>array('admin')),
);
?>

<h1>Create CompetitionSource</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>