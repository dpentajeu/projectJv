<?php
$cs = Yii::app()->getClientScript();
$cs->registerPackage('tag-it');
$cs->registerScript('tag-it', "
	$('#tags').tagit();
	");
$cs->registerCss('tag-it', "
	form .row input {
		border: 1px solid black;
		padding: 5px;
	}

	form .row span {
		margin-left: 10px;
		padding: 5px;
		color: black;
	}
	");
?>
<div class="container">
	<h2>Congratulation! Your campaign has been created.</h2>
	<div class="span-12">
		<h2 style="margin-bottom:0;">Sample Form</h2>
		<form style='background:#eee'>
			<?php echo $model->wizard; ?>
		</form>
	</div>

	<div class="span-12 wizard last">
		<h2 style="margin-bottom:0;">Tags</h2>
		<ul id="tags">
		<?php foreach ($model->tags as $tag): ?>
			<li><?php echo $tag; ?></li>
		<?php endforeach; ?>
		</ul>
	</div>

	<div class="buttons">
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/site/campaign" class="next">All Campaign</a>
	</div>

</div>