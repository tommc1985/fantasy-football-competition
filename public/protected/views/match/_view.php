<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tie_id')); ?>:</b>
	<?php echo CHtml::encode($data->tie_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_club_id')); ?>:</b>
	<?php echo CHtml::encode($data->home_club_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('away_club_id')); ?>:</b>
	<?php echo CHtml::encode($data->away_club_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_club_points')); ?>:</b>
	<?php echo CHtml::encode($data->home_club_points); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('away_club_points')); ?>:</b>
	<?php echo CHtml::encode($data->away_club_points); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('home_club_tie_breaker')); ?>:</b>
	<?php echo CHtml::encode($data->home_club_tie_breaker); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('away_club_tie_breaker')); ?>:</b>
	<?php echo CHtml::encode($data->away_club_tie_breaker); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->start_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finish_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->finish_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg_number')); ?>:</b>
	<?php echo CHtml::encode($data->leg_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('replay')); ?>:</b>
	<?php echo CHtml::encode($data->replay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_modified')); ?>:</b>
	<?php echo CHtml::encode($data->date_modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	*/ ?>

</div>