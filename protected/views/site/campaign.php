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
				<?php 
				// $this->widget('zii.widgets.grid.CGridView', array(
				// 	'dataProvider'=>$dataProvider,
				// 	'template'=>"{items}{pager}",
				// 	'pager'=>array('header'=>''),
				// 	'columns'=>array(
				// 		array('name'=>'EventName', 'header'=>'Event Name'),
				// 		),
				// 	)); ?>
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
						<td><?php echo CHtml::link($campaign['EventName'], $this->createUrl('result', array('id'=>$campaign['EventID']))); ?></td>
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
				<table>
					<thead>
						<tr>
							<th>Form ID</th>
							<th>Form Name</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($form['Data'] as $f): ?>
					<tr>
						<td><?php echo $f['FormID']; ?></td>
						<td><?php echo $f['FormName']; ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>