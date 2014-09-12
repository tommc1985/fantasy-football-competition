<?php
$this->breadcrumbs=array(
	'Matches'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Match','url'=>array('index')),
	array('label'=>'Create Match','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('match-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Matches</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'match-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'tie_id',
		'home_club_id',
		'away_club_id',
		'name',
		'home_club_points',
		/*
		'away_club_points',
		'home_club_tie_breaker',
		'away_club_tie_breaker',
		'start_datetime',
		'finish_datetime',
		'leg_number',
		'replay',
		'status',
		'date_created',
		'date_modified',
		'deleted',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
