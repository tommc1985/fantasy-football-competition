<?php
$errorSummary = $form->errorSummary($model);
if ($errorSummary) { ?>
<tr>
	<td class="span24" colspan="6"><?php echo $errorSummary; ?></td>
</tr>
<?php
} ?>
<tr>
	<td><?php echo CHtml::activeHiddenField($model,"[{$row}]id",array('class'=>'span1')); ?><?php echo CHtml::activeHiddenField($model,"[{$row}]parent_id",array('class'=>'span1')); ?><?php echo CHtml::activeHiddenField($model,"[{$row}]competition_id",array('class'=>'span1')); ?><?php echo CHtml::activeHiddenField($model,"[{$row}]order",array('class'=>'span1')); ?><?php echo CHtml::activeTextField($model,"[{$row}]name",array('class'=>'span2','maxlength'=>255)); ?></td>
	<td><?php echo CHtml::activeDateField($model,"[{$row}]start_datetime",array('class'=>'span2')); ?></td>
	<td><?php echo CHtml::activeDateField($model,"[{$row}]finish_datetime",array('class'=>'span2')); ?></td>
	<td><?php echo CHtml::activeNumberField($model,"[{$row}]legs",array('class'=>'span1')); ?></td>
	<td><?php echo CHtml::activeDropDownList($model,"[{$row}]replay", Round::replayOptions(),array('class'=>'span1','empty'=>'--- Select ---')); ?></td>
	<td><?php echo CHtml::activeDropDownList($model,"[{$row}]tie_breaker", Round::tiebreakers(),array('class'=>'span1')); ?></td>
</tr>