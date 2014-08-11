<?php
$this->breadcrumbs=array(
	'Competition Sources'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompetitionSource','url'=>array('index')),
	array('label'=>'Create CompetitionSource','url'=>array('create')),
	array('label'=>'View CompetitionSource','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CompetitionSource','url'=>array('admin')),
);
?>

<h1>Update CompetitionSource <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>