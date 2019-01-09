<?php
/* @var $this DisorderController */
/* @var $model Disorder */

$this->breadcrumbs=array(
	'Disorders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Disorder', 'url'=>array('index')),
	array('label'=>'Create Disorder', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#disorder-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p class="description-note note">
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'button large')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'disorder-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fully_specified_name',
		'term',
		'last_modified_user_id',
		'last_modified_date',
		'created_user_id',
		'created_date',
		'specialty_id',
		'active',
		array(
			'class'=>'CButtonColumn',
            'deleteButtonOptions'=>array('class' => 'oe-i trash small hint'),
            'deleteButtonImageUrl'=> '',
            'deleteButtonLabel'=>'',
            'updateButtonOptions'=>array('class' => 'oe-i pencil small'),
            'updateButtonImageUrl'=> '',
            'updateButtonLabel'=>'',
            'viewButtonOptions'=>array('class' => 'oe-i info small'),
            'viewButtonImageUrl'=> '',
            'viewButtonLabel'=> '',
		),
	),
    'pager'=>array('class'=>'LinkPager'),
    'pagerCssClass'=>'pagination',
    'itemsCssClass'=>'standard highlight-rows',
)); ?>
<?= CHtml::link('Add New Disorder', Yii::app()->createURL('disorder/create'),array('class' => 'button large')) ?>
