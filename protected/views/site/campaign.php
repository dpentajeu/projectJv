<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Campaign',
);
?>

<div class="grid_16">
	<h1>Campaign</h1>

	<p>
		<table>
			<thead>
				<tr>
					<th>Event name</th>
					<th>Venue</th>
					<th>Start date</th>
					<th>End date</th>
					<th>Remarks</th>					
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
	</p>

	<p>
		<div class="buttons">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/site/createcampaign">Add new campaign</a>
		</div>
	</p>
</div>
