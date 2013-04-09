<?php
$cs = Yii::app()->getClientScript();
$cs->registerPackage('form-wizard');
?>
<div class="container">
<div class="span-12 wizard">
	<h3>Form Wizard &nbsp&nbsp<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/edit.png" width="32px" height="32px" alt=""></h3>
	<div class="buttons">
		<button data-type="text">Text field</button>
		<button data-type="number">Numeric field</button>
		<button data-type="datepicker">Date field</button>
		<div style="height: 30px;"></div>
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/site/createcampaign?step=3">Next</a>
	</div>
</div>

<div class="span-12 last">
	<h2>Sample Form</h2>
	<form name='wizard' style='background:#eee'></form>
</div>
</div>