<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('round_id')); ?>:</b>
	<?php echo CHtml::encode($data->round_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_tie_id')); ?>:</b>
	<?php echo CHtml::encode($data->home_tie_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('away_tie_id')); ?>:</b>
	<?php echo CHtml::encode($data->away_tie_id); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('home_club_points')); ?>:</b>
	<?php echo CHtml::encode($data->home_club_points); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('away_club_points')); ?>:</b>
	<?php echo CHtml::encode($data->away_club_points); ?>
	<br />

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

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_modified')); ?>:</b>
	<?php echo CHtml::encode($data->date_modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	*/ ?>

</div>