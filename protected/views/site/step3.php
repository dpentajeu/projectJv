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
		<h1>Add Tags</h1>
		<span>Press enter/tab to create a tag.</span>
		<ul id="tags"></ul>
	</form>

	<p>
		<div class="buttons">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/site/campaign">Complete</a>
		</div>
	</p>
</div>