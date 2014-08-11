<?php
$this->breadcrumbs=array(
	'Competition Sources',
);

$this->menu=array(
	array('label'=>'Create CompetitionSource','url'=>array('create')),
	array('label'=>'Manage CompetitionSource','url'=>array('admin')),
);
?>

<h1>Competition Sources</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
