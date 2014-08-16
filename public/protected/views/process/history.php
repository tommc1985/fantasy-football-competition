<h1>Process</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'competition-source-grid',
    'dataProvider'=>$dataProvider->search(),
    'filter'=>$dataProvider,
    'columns'=>array(
        'id',
        'url',
        'success',
        'date_created',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '',
        ),
    ),
)); ?>