<?php
$cs = Yii::app()->getClientScript();
$cs->registerPackage('tag-it');
$cs->registerScript('tag-it', "
	$(document).ready(function() {
		$('#tags').tagit({
			allowSpaces: true,
			autocomplete: 'disabled',
		});
	});
	");
?>
<div>
	<form>
		<h1>Tagging</h1>
		<ul id="tags"></ul>
	</form>
</div>