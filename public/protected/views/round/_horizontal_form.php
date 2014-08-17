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
<?php
$replayRound = $model->rounds ? $model->rounds[0] : new Round();
if ($replayRound) { ?>
<tr id="replay_<?php echo $row; ?>">
    <td>Replay Date<?php echo CHtml::activeHiddenField($replayRound,"[{$row}][replay_round]id",array('class'=>'span1')); ?></td>
    <td><?php echo CHtml::activeDateField($replayRound,"[{$row}][replay_round]start_datetime",array('class'=>'span2')); ?></td>
    <td><?php echo CHtml::activeDateField($replayRound,"[{$row}][replay_round]finish_datetime",array('class'=>'span2')); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<script type="text/javascript">
function showHideTie<?php echo $row; ?>()
{
    if (jQuery('#Round_<?php echo $row; ?>_replay').val() == 1) {
        jQuery('#replay_<?php echo $row; ?>').show();
    } else {
        jQuery('#replay_<?php echo $row; ?>').hide();
    }
}

jQuery(document).ready(function() {
    showHideTie<?php echo $row; ?>();
});

jQuery('#Round_<?php echo $row; ?>_replay').on('change', function() {
    showHideTie<?php echo $row; ?>();
});
</script>
<?php
} ?>