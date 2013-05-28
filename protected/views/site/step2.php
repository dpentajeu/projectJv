<?php
$cs = Yii::app()->getClientScript();
$cs->registerPackage('form-wizard');
$cs->registerScript('next', "
	$('.buttons a').click(function() {
		var input = [],
			formInput = [],
			formType = [];

		$('form span').each(function(i, o) { formInput.push($(o).html()); formType.push('Text'); });
		input.push($('<input />').attr('hidden', true).attr('name', 'wizard').val($('form').html()));
		input.push($('<input />').attr('hidden', true).attr('name', 'formInput').val(formInput.join('|')));
		input.push($('<input />').attr('hidden', true).attr('name', 'formType').val(formType.join('|')));
		$('form').append(input);
		$('form').submit();
	});
	");
?>
<div class="container">
    <div class="span-8 wizard last">	
	<!--<h3>Form Wizard &nbsp&nbsp<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/edit.png" width="32px" height="32px" alt=""></h3> -->
        <div class="buttons">
                <br/><br/>
		<button data-type="text">Text field</button>
                <div>Ex: Name, Email</div>
		<button data-type="number">Numeric field</button>
                <div>Ex: Price, Age</div>
		<button data-type="datepicker">Date field</button>
                <div>Ex: Date</div>
		<div style="height: 30px;"></div>
		<a href="javascript:void(0);" class="next">Next</a>
	</div>
    </div>
    <div class="span-14">
            <!--<h2><?php echo $model->form; ?></h2> -->
            <h2>Create Form</h2>
            <form name='wizard' action="?step=3" style='background:#eee'></form>
    </div>
</div>