<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Campaign',
);
$cs = Yii::app()->getClientScript();
$cs->registerPackage('organic-tab');
$cs->registerScript('tab', "
	$('#example-two').organicTabs();
	");
?>

<div class="grid_16">
	<h1>Campaign</h1>
	<div id="example-two">
		<ul class="nav">
			<li class="nav-one"><a href="#event" class="current">Events</a></li>
			<li class="nav-two"><a href="#forms">Forms</a></li>
		</ul>
		<div class="list-wrap">
			<div id="event">
				<table>
					<thead>
						<tr>
							<th>Event name</th>
							<th>Venue</th>
							<th>Start date</th>
							<th>End date</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($list['Data'] as $campaign): ?>
					<tr>
						<td><?php echo CHtml::link($campaign['EventName'], array('/site/result')); ?></td>
						<td><?php echo $campaign['EventVenue']; ?></td>
						<td><?php echo $campaign['EventStart']; ?></td>
						<td><?php echo $campaign['EventEnd']; ?></td>
						<td></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<div class="row">
					<div class="buttons">
						<a href="<?php echo $this->createUrl('createcampaign'); ?>" class="next">Add new campaign</a>
					</div>
				</div>
			</div>
			<div id="forms" class="hide">
				something
			</div>
		</div>
	</div>
</div>