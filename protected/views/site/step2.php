<?php
$cs = Yii::app()->getClientScript();
$cs->registerPackage('form-wizard');
?>
<div class="span-8 wizard">
	<h1>Form Wizard</h1>
	<button data-type="text">Text field</button>
	<button data-type="number">Numeric field</button>
	<button data-type="datepicker">Date field</button>
</div>

<div class="span-12">
	<h1>Sample Form Output</h1>
	<form name='wizard'></form>
</div>