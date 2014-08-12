<h2>Registrations</h2>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'competition-registration-form',
    'enableAjaxValidation'=>false,
)); ?>

<?php //echo $form->errorSummary($model); ?>

<div id="competition-grid" class="grid-view">
        <table class="items table">
        <thead>
            <tr>
                <th id="competition-grid_c1">Club</a></th>
                <th id="competition-grid_c2">Identifer</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($models as $model) { ?>
            <tr class="<?php echo $i % 2 ? 'odd' : 'even'; ?>">
                <td><?php echo $form->dropDownListRow($model,'club_id', CHtml::listData(Club::model()->findAll(), 'id', 'name'),array('class'=>'span8','empty'=>'--- Select ---')); ?></td>
                <td><?php echo $form->textFieldRow($model,'identifier',array('class'=>'span5','maxlength'=>255)); ?></td>
            </tr>
            <?php
                $i++;
            } ?>
        </tbody>
    </table>
</div>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Save',
        )); ?>
    </div>

<?php $this->endWidget(); ?>