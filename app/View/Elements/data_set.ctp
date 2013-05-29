  <style type="text/css">
	#map_canvas { height: 500px; }
	#example3 { height: 400px; 
		background-color: skyblue;
	}
</style>

    <script>
    $(function() {
		var values = [13, 4, 2];
		<?php foreach ($questions as $question): ?>
			$('#sparkline<?php echo $question["Question"]["id"]?>').sparkline(values, {
			    type: "pie",
			       width: '400px',
			        height: '400px',
			    tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
			    tooltipValueLookups: {
			        'offset': {
			            0: 'Tuberia rota',
			            1: 'No hay agua en la zona',
			            2: 'Otros'
			        }
			    },
			});
		<?php endforeach; ?>
    });
    </script>
<div class="dataSets view">

<div class="row">
	<div class="span9">
	</div>
	<div class="span3">
	<p>
  <button class="btn btn-large  btn-success" type="button">Descargar Datos</button>
  <button class="btn btn-large btn-warning" type="button">API</button>
		</p>
	</div>
</div>

  <script type="text/javascript"> 

   

   </script> 

<script>
	

	function initialize() {
		var map = new google.maps.Map(document.getElementById('map_canvas'), { 
		 mapTypeId: google.maps.MapTypeId.SATELLITE
		});

		var markerBounds = new google.maps.LatLngBounds();

		var randomPoint, i;

	<?php foreach ($challenge['Survey'][0]['SurveyAnswer'] as $survey_answer): ?>
		 point = new google.maps.LatLng( <?php echo $survey_answer['Point']['lat']; ?>, <?php echo $survey_answer['Point']['lng']; ?>);
		 
		 marker<?php echo $survey_answer['id'] ?> = new google.maps.Marker({
		   position: point,
		   map: map
		 });

		 	contentString = '<h3>Sanitario ecologico</h3>'+
		 	'<img src="http://www.aquamapas.com/img/points/'+$survey_answer['Point']['id']+'.jpg" width="200px"> <br>';
		<?php foreach ($survey_answer['QuestionAnswer'] as $question_answer): ?>
			contentString += '<b><?php echo isset($question_answer["Question"]["name"]) ? $question_answer["Question"]["name"] : ''  ?> </b><br>';
			contentString += '<?php echo $question_answer["value"] ?> <br>';	
		<?php endforeach; ?>

		infowindow<?php echo $survey_answer['id'] ?> = new google.maps.InfoWindow({
		  	content: contentString
		});

		google.maps.event.addListener(marker<?php echo $survey_answer['id'] ?>, 'click', function() {
			infowindow<?php echo $survey_answer['id'] ?>.open(map,marker<?php echo $survey_answer['id'] ?>);
		});

		markerBounds.extend(point);

	<?php endforeach; ?> 
		map.fitBounds(markerBounds);

	}
	google.maps.event.addDomListener(window, 'load', initialize);

	
</script>
<!-- Mapa -->
<legend>

<?php if(sizeof($challenge['Survey'][0]['SurveyAnswer']) > 0 ) {?>
	<h3>Mapa</h3>
	</legend>
	<div class="row">

		<div class="span12 thumbnail">
			<div id="map_canvas">
				....
			</div>
		</div>
	</div>
	<!-- Mapa -->

	<!--
	<legend>
	<h3>Resultados</h3>
	</legend>

			<ul class="thumbnails challenges">

			<?php foreach ($questions as $question): ?>

				<li class="span6">
					<a class="thumbnail" href="#" style="text-align: center; max-height: 500px; height: 400px;">
						<span id="sparkline<?php echo $question['Question']['id']?>" >&nbsp;</span>
						<!--<div class="caption" style="position: relative; matgin-bottom: 50px;">

						</div>
					-->
	<!--				</a>

	<h3> <?php echo $question["Question"]["name"] ?>
					</h3>
					
				</li> 
			<?php endforeach; ?> 
	        
	        </ul>
	</div>
	-->
<?php } ?>

<?php echo $this->Html->script(array('http://d3js.org/d3.v3.min.js','xcharts.min')); ?>

<script>
$(document).ready(function() {
		
		var data = {
		  "xScale": "time",
		  "yScale": "linear",
		  "type": "line",
		  "main": [
		    {
		      "className": ".pizza",
		      "data": [
		        {
		          "x": "2013-05-05",
		          "y": 1
		        },
		        {
		          "x": "2013-05-06",
		          "y": 6
		        },
		        {
		          "x": "2013-05-07",
		          "y": 13
		        },
		        {
		          "x": "2013-05-08",
		          "y": 2
		        },
		        {
		          "x": "2013-05-09",
		          "y": 8
		        },
		        {
		          "x": "2013-05-10",
		          "y": 10
		        },
		        {
		          "x": "2013-05-11",
		          "y": 6
		        }
		      ]
		    }
		  ]
		};

		var opts = {
		  "dataFormatX": function (x) { return d3.time.format('%Y-%m-%d').parse(x); },
		  "tickFormatX": function (x) { return d3.time.format('%A')(x); }
		};
		var myChart = new xChart('line', data, '#example3', opts);
		
	});
</script>



