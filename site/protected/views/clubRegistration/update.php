<?php
$this->breadcrumbs=array(
	'Club Registrations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClubRegistration','url'=>array('index')),
	array('label'=>'Create ClubRegistration','url'=>array('create')),
	array('label'=>'View ClubRegistration','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ClubRegistration','url'=>array('admin')),
);
?>

<h1>Update ClubRegistration <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>