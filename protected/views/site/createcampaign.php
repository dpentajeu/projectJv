<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	'Create Campaign',
);
$cs = Yii::app()->getClientScript();
$cs->registerPackage('jui');
$cs->registerScript('date', "
	$('#CampaignForm_startDate').datepicker();
	$('#CampaignForm_endDate').datepicker();
	");
$cs->registerCss('form', "
	.row label {
		display: inline-block;
		width: 150px;
		text-align: right;
		margin-right: 10px;
	}
	");
?>

<div class="grid_16">
<h2>Add new campaign</h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'action'=>'?step=2',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'form'); ?>
		<?php echo $form->textField($model,'form'); ?>
		<?php echo $form->error($model,'form'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'venue'); ?>
		<?php echo $form->textField($model,'venue'); ?>
		<?php echo $form->error($model,'venue'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'startDate'); ?>
		<?php echo $form->textField($model,'startDate'); ?>
		<?php echo $form->error($model,'startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'endDate'); ?>
		<?php echo $form->textField($model,'endDate'); ?>
		<?php echo $form->error($model,'endDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Next'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>