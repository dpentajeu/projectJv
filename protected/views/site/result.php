<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Result',
);

$cs = Yii::app()->getClientScript();
$baseUrl = Yii::app()->request->baseUrl;
$cs->registerCssFile("{$baseUrl}/css/tabstyle.css");
$cs->registerScriptFile("https://www.google.com/jsapi");
$cs->registerScriptFile("{$baseUrl}/js/organictabs.jquery.js");
$cs->registerScript('',"
	$('#example').organicTabs();
	");
?>
<script type="text/javascript">
	// Load the Visualization API and the piechart package.
	google.load('visualization', '1.0', {'packages':['corechart']});

	// Set a callback to run when the Google Visualization API is loaded.
	google.setOnLoadCallback(drawChart);
	// google.setOnLoadCallback(drawGraph);

	// Callback that creates and populates a data table,
	// instantiates the pie chart, passes in the data and
	// draws it.
	function drawChart() {

		// Create the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Age group');
		data.addColumn('number', 'No of Person');
		data.addRows([
			['Male 18-25', 3],
			['Male 26-35', 1],
			['Male 36-45', 1],
			['Male 46-55', 1],
			['Male 55 & above', 2]
		]);

		// Set chart options
		var options = {
			'title':'Demographic of Customer Who Is Using Product X?',
			'width':700,
			'height':400
		};

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		function selectHandler() {
			var selectedItem = chart.getSelection()[0];
			if (selectedItem) {
				var val = data.getValue(selectedItem.row, 0);
				alert('Data for ' + val);
			}
		}

		google.visualization.events.addListener(chart, 'select', selectHandler); 
		chart.draw(data, options);
	}

	function drawGraph() {
		var data = google.visualization.arrayToDataTable([
			['Day', 'Male', 'Female'],
			['1', 3, 4],
			['2', 1, 5],
			['3', 2, 7],
			['4', 3, 2]
		]);

		var options = {
			title: 'Daily Performance of Product X Campaign',
			'width':700,
			'height':400
		};

		var chart = new google.visualization.LineChart(document.getElementById('line_div'));
		chart.draw(data, options);
	}
</script>

<div class="grid_16">
	<h1>Result</h1>
	<h3 style="padding-bottom: 10px; border-bottom: 2px solid #eee">Campaign X <br/>Venue: One Utama &nbsp&nbsp Start Date: 20/11/2012 &nbsp&nbsp End Date: 12/12/2012</h3>  
	<div class="container">
		<div class="span-2"></div>
		<div class="span-20">
			<div id="example">
				<ul class="nav">
					<li class="nav-one"><a href="#pie" class="current">Chart</a></li>
					<li class="nav-two"><a href="#line">Map</a></li>
				</ul>
				<div class="list-wrap">
					<ul id="pie">
						<div id="chart_div"></div>
					</ul>

					<ul id="line" class="hide">
						<div id="line_div">
							<iframe width="730" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=+&amp;q=cyberjaya&amp;ie=UTF8&amp;hq=&amp;hnear=Cyberjaya,+Selangor,+Malaysia&amp;ll=2.925088,101.657381&amp;spn=0.005957,0.009871&amp;t=m&amp;z=14&amp;output=embed"></iframe>
						</div>
					</ul>
				</div>    
			</div>
		</div>
		<div class="span-2 last"></div>
	</div>

	<div class="container">
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>DOB</th>
					<th>Age</th>
					<th>Address</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Jin Lim</td>
					<td>jin@jin.com</td>
					<td>60175225252</td>
					<td>12/12/2012</td>
					<td>15</td>
					<td>7, Jln 123, Tmn Ipoh.</td>
				</tr>
				<tr>
					<td>Jin Lim</td>
					<td>jin@jin.com</td>
					<td>60175225252</td>
					<td>12/12/2012</td>
					<td>15</td>
					<td>7, Jln 123, Tmn Ipoh.</td>
				</tr>
				<tr>
					<td>Jin Lim</td>
					<td>jin@jin.com</td>
					<td>60175225252</td>
					<td>12/12/2012</td>
					<td>15</td>
					<td>7, Jln 123, Tmn Ipoh.</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>