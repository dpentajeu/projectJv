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
					<th>Budget (RM)</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/result">Nestle</a></td>
					<td>One Utama</td>
					<td>20/11/2012</td>
					<td>12/12/2012</td>
					<td>Special campaign.</td>
					<td>5000</td>
				</tr>
				<tr>
					<td><a href="#">Nestle</a></td>
					<td>One Utama</td>
					<td>20/11/2012</td>
					<td>12/12/2012</td>
					<td>-</td>
					<td>5000</td>
				</tr>
				<tr>
					<td><a href="#">Nestle</a></td>
					<td>One Utama</td>
					<td>20/11/2012</td>
					<td>12/12/2012</td>
					<td>-</td>
					<td>5000</td>
				</tr>
			</tbody>
		</table>
	</p>

	<p>
		<div class="buttons">
			<a href="#">Add new campaign</a>
		</div>
	</p>
</div>
