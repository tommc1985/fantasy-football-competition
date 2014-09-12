<?php
$errorSummary = $form->errorSummary($model);
if ($errorSummary) { ?>
<tr>
	<td class="span24" colspan="6"><?php echo $errorSummary; ?></td>
</tr>
<?php
} ?>
<tr>
	<td><?php echo CHtml::activeHiddenField($model,"[{$roundNumber}]id",array('class'=>'span1')); ?><?php echo CHtml::activeHiddenField($model,"[{$roundNumber}]parent_id",array('class'=>'span1')); ?><?php echo CHtml::activeHiddenField($model,"[{$roundNumber}]competition_id",array('class'=>'span1')); ?><?php echo CHtml::activeHiddenField($model,"[{$roundNumber}]order",array('class'=>'span1')); ?><?php echo CHtml::activeTextField($model,"[{$roundNumber}]name",array('class'=>'span2','maxlength'=>255)); ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><?php echo CHtml::activeDropDownList($model,"[{$roundNumber}]two_legged", Round::twoLeggedOptions(),array('class'=>'span1')); ?></td>
	<td><?php echo CHtml::activeDropDownList($model,"[{$roundNumber}]number_of_replays", Round::replayOptions(),array('class'=>'span1')); ?></td>
	<td><?php echo CHtml::activeDropDownList($model,"[{$roundNumber}]tie_breaker", Round::tiebreakers(),array('class'=>'span1')); ?></td>
</tr>

<tr id="round_<?php echo $roundNumber; ?>_leg_1">
    <td><span class="round-<?php echo $roundNumber; ?>-1-match">Match</span><span class="round-<?php echo $roundNumber; ?>-2-matches">1st Leg</span></td>
    <td><?php echo CHtml::activeDateField($model,"[{$roundNumber}]dates[start_datetime][leg_1]",array('class'=>'span2')); ?></td>
    <td><?php echo CHtml::activeDateField($model,"[{$roundNumber}]dates[end_datetime][leg_1]",array('class'=>'span2')); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr id="round_<?php echo $roundNumber; ?>_leg_2">
    <td>2nd Leg</td>
    <td><?php echo CHtml::activeDateField($model,"[{$roundNumber}]dates[start_datetime][leg_2]",array('class'=>'span2')); ?></td>
    <td><?php echo CHtml::activeDateField($model,"[{$roundNumber}]dates[end_datetime][leg_2]",array('class'=>'span2')); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr id="round_<?php echo $roundNumber; ?>_replay_1">
    <td>Replay</td>
    <td><?php echo CHtml::activeDateField($model,"[{$roundNumber}]dates[start_datetime][replay_1]",array('class'=>'span2')); ?></td>
    <td><?php echo CHtml::activeDateField($model,"[{$roundNumber}]dates[end_datetime][replay_1]",array('class'=>'span2')); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<script type="text/javascript">
function showHideTie<?php echo $roundNumber; ?>()
{
    // Show/Hide 2nd Leg row
    if (jQuery('#Round_<?php echo $roundNumber; ?>_two_legged').val() == 1) {
        jQuery('#round_<?php echo $roundNumber; ?>_leg_2').show();

        jQuery('.round-<?php echo $roundNumber; ?>-1-match').hide();
        jQuery('.round-<?php echo $roundNumber; ?>-2-matches').show();
    } else {
        jQuery('#round_<?php echo $roundNumber; ?>_leg_2').hide();

        jQuery('.round-<?php echo $roundNumber; ?>-1-match').show();
        jQuery('.round-<?php echo $roundNumber; ?>-2-matches').hide();
    }

    // Show/Hide Replay row
    if (jQuery('#Round_<?php echo $roundNumber; ?>_number_of_replays').val() == 1) {
        jQuery('#round_<?php echo $roundNumber; ?>_replay_1').show();
    } else {
        jQuery('#round_<?php echo $roundNumber; ?>_replay_1').hide();
    }
}

jQuery(document).ready(function() {
    showHideTie<?php echo $roundNumber; ?>();
});

jQuery('#Round_<?php echo $roundNumber; ?>_number_of_replays, #Round_<?php echo $roundNumber; ?>_two_legged').on('change', function() {
    showHideTie<?php echo $roundNumber; ?>();
});
</script>