  <style type="text/css">
	#map_canvas { height: 500px; }
	#example3 { height: 400px; 
		background-color: skyblue;
	}
</style>

    <script>
    $(function() {

		var values = [13, 4, 2];
		$('#sparkline1').sparkline(values, {
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
    });
    </script>
<div class="dataSets view">
	<legend>

<h1>Averias en lineas de agua o saneamiento Cochabamba</h1>
</legend>

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


<script>
	
	function initialize() {
		var mapOptions = {
			zoom: 13,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
		
		map.setCenter(new google.maps.LatLng(-17.390614,-66.169968));

		var contentString = '<h3> Averia reportada </h3>' +
							'<b>Tipo:</b>  Tuberia rota <br>' +
							'<b>Fecha:</b> 05/05/2013 <br>' +
							'<br>' +
							'<img src="http://images.lainformacion.com/cms/psoe-guadalajara-denuncia-el-despilfarro-de-600-millones-de-litros-de-agua-por-la-averia-de-la-tuberia-de-valdegrudas/2012_4_10_Q1XU1kr0OMIaihzR0WGS61.jpg" width="200px">';
		

		var myLatlng = new google.maps.LatLng(-17.390614,-66.169968);

		var infowindow = new google.maps.InfoWindow({
		  content: contentString
		});


		var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: map,
		  title: 'Averia'
		});

		google.maps.event.addListener(marker, 'click', function() {
		 infowindow.open(map,marker);
		});


		var contentString1 = '<h3>Averia reportadas </h3>' +
							'<b>Tipo:</b>  Otros <br>' +
							'<b>Fecha:</b> 06/05/2013 <br>' +
							'<br>';
		

		var myLatlng = new google.maps.LatLng(-17.404373,-66.161728);

		var infowindow1 = new google.maps.InfoWindow({
		  content: contentString1
		});


		var marker1 = new google.maps.Marker({
		  position: myLatlng,
		  map: map,
		  title: 'Averia'
		});
		
		google.maps.event.addListener(marker1, 'click', function() {
		 infowindow1.open(map,marker1);
		});


		var contentString2 = '<h3>Averia reportadas </h3>' +
							'<b>Tipo:</b>  No hay agua en la zona <br>' +
							'<b>Fecha:</b> 07/05/2013 <br>' +
							'<br>';
		

		var myLatlng = new google.maps.LatLng(-17.413546,-66.203613);

		var infowindow2 = new google.maps.InfoWindow({
		  content: contentString1
		});


		var marker2 = new google.maps.Marker({
		  position: myLatlng,
		  map: map,
		  title: 'Averia'
		});
		
		google.maps.event.addListener(marker2, 'click', function() {
		 infowindow2.open(map,marker2);
		});

	}

	google.maps.event.addDomListener(window, 'load', initialize);


</script>
<!-- Mapa -->
<legend>
<h3>Mapa</h3>
</legend>

<div class="row">
	<div class="span8">


		<div id="map_canvas">
			hjh
		</div>

	</div>

	<div class="span4">
			<legend>Filtros: </legend>

			<select>
				<option>Ver todos</option> 
				<option>Tuberias rotas</option> 
				<option>No hay agua en la zona</option> 
				<option>Otros</option> 
			</select>
	</div>
</div>
<!-- Mapa -->
<legend>
<h3>Resultados</h3>
</legend>

		<ul class="thumbnails challenges">
			<li class="span6">
				<a class="thumbnail" href="#" style="text-align: center; max-height: 500px; height: 400px; background-color: 'blue';">
					<div id="example3"> </div>
					<div class="caption" style="position: relative; matgin-bottom: 50px;">
						<h4> Reportes por fecha
						</h4>
					</div>
				</a>
			</li>
			
			<li class="span6">
				<a class="thumbnail" href="#" style="text-align: center; max-height: 500px; height: 400px;">
					<span id="sparkline1" >&nbsp;</span>
					<div class="caption" style="position: relative; matgin-bottom: 50px;">
						<h4> P1: 
							Tipo de averia
						</h4>
					</div>
				</a>
			</li>         
        </ul>
</div>
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

