<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<div class="grid_16">
	<h1 style="color:#2B9FD9; text-align: center">Join our campaign and win freebies.</h1>

	<div class="container">
		<div class="span-8">
			<span style="padding: 300px"></span>
		</div>
		<div class="span-8">
			<h2>Login</h2>

			<p>Please fill out the following form with your login credentials:</p>

			<div class="form">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->request->baseUrl.'/site/login',
				'id'=>'login-form',
				'enableClientValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			)); ?>

				<p class="note">Fields with <span class="required">*</span> are required.</p>

				<div class="row">
					<?php echo $form->labelEx($model,'username'); ?>
					<?php echo $form->textField($model,'username'); ?>
					<?php echo $form->error($model,'username'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'password'); ?>
					<?php echo $form->passwordField($model,'password'); ?>
					<?php echo $form->error($model,'password'); ?>
					<p class="hint">
						Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
					</p>
				</div>

				<div class="row buttons">
					<?php echo CHtml::submitButton('Login'); ?>
				</div>

			<?php $this->endWidget(); ?>
			</div><!-- form -->
		</div>
		<div class="span-8 last">
			
		</div>		
	</div>
</div>
<div class="container">
			<h1 style="color:#3670B7; text-align: center; font-size: 18px">
				Quisque sed bibendum turpis. Cras eu felis sed quam accumsan elementum. Cras laoreet lacus tortor, ac cursus dui. Phasellus tortor erat, aliquam in tempus vel, ultricies sit amet augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sit amet sapien id ipsum vestibulum vulputate. Vestibulum sodales tincidunt magna non iaculis. Nam dapibus consequat convallis. Phasellus semper felis congue diam interdum varius.
			</h1>
		</div>
