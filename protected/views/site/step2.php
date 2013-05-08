<?php
$cs = Yii::app()->getClientScript();
$cs->registerPackage('form-wizard');
$cs->registerScript('next', "
	$('.buttons a').click(function() {
		var input = $('<input />').attr('hidden', true).attr('name', 'wizard').val($('form').html());
		$('form').append(input);
		$('form').submit();
	});
	");
?>
<div class="container">
<div class="span-12">
	<h2><?php echo $model->form; ?></h2>
	<form name='wizard' action="?step=3" style='background:#eee'></form>
</div>

<div class="span-12 wizard last">	
	<h3>Form Wizard &nbsp&nbsp<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/edit.png" width="32px" height="32px" alt=""></h3>
	<div class="buttons">
		<button data-type="text">Text field</button>
		<button data-type="number">Numeric field</button>
		<button data-type="datepicker">Date field</button>
		<div style="height: 30px;"></div>
		<a href="javascript:void(0);" class="next">Next</a>
	</div>
</div>
</div>