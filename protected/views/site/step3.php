<?php
$cs = Yii::app()->getClientScript();
$cs->registerPackage('tag-it');
$cs->registerScript('tag-it', "
	$(document).ready(function() {
		$('#tags').tagit({ fieldName: 'tags[]', allowSpaces: true, });
		$('.buttons a').click(function() {
			$('form').submit();
		});
	});
	");
$cs->registerCss('tag-it', "
	.ui-helper-hidden-accessible {
		display: none;
	}
	");
?>
<div>
	<form action="?step=4" method="post">
		<h1>Add Tags</h1>
		<span>Press enter/tab to create a tag.</span>
		<ul id="tags"></ul>
	</form>

	<p>
		<div class="buttons">
			<a href="javascript:void(0);">Complete</a>
		</div>
	</p>
</div>