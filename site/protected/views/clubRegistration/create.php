<?php
$this->breadcrumbs=array(
	'Club Registrations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClubRegistration','url'=>array('index')),
	array('label'=>'Manage ClubRegistration','url'=>array('admin')),
);
?>

<h1>Create ClubRegistration</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>