<?php
$cs = Yii::app()->getClientScript();
$cs->registerPackage('form-wizard');
$cs->registerPackage('tag-it');
$cs->registerPackage('organic-tab');
$cs->registerScript('tab', "
	$('#example-two').organicTabs();
	");
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
<div class="grid_16">
	<h2>Congratulation! <?php echo $model->name; ?> created.</h2>
    <div id="example-two">
            <ul class="nav">
                    <li class="nav-one"><a href="#summary" class="current">Summary</a></li>
                    <li class="nav-two"><a href="#html">HTML Code</a></li>
            </ul>
            <div class="list-wrap">
                    <div id="summary">
                        <div class="container">
                            <div class="span-12">
                                    <h2 style="margin-bottom:0;"><?php echo $model->form; ?></h2>
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
                                    <a href="<?php echo $this->createUrl('site/campaign'); ?>" class="next">All Campaign</a>
                                    <a href="<?php echo $this->createUrl("site/result/{$model->eventId}"); ?>" class="next">Report</a>
                            </div>
                        </div>
                    </div>
                    <div id="html" class="hide">
                        <label>Embed code to your website:</label><br/>
                        <textarea id="holdtext" style="width: 50%; height: 100px;"><iframe src="<?php echo $this->createAbsoluteUrl('formgenerator', array('id'=>$model->eventId)); ?>" style="width: 100%; height: 200px;"></iframe></textarea><br/>
                    </div>
            </div>
    </div>
</div>
