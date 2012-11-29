<script>
var map;
var dotsTableName = '1fi7TpPzqakAfgrWWe-OWAOKZE_WLe1eIVl87q2o';
var areaTableName = '1IW43AblTgBE6OGz79hqMjq3yv_saG88OuE4pBJk';
//var areaTableName = '1ZT5rrWyUSAmJBJim-FaMBxwrG6CpcmI5TYAsm3Y';
var apiKey = 'AIzaSyB1EjUV_8Lmq6YkAQ04jwRttfGft94bXX0';

var dotsLayer = null;
var areaLayer = null;

function initialize() {
	var mapOptions = {
		zoom: 7,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
	
	// Try HTML5 geolocation
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
		var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		
		/*var infowindow = new google.maps.InfoWindow({
		map: map,
		position: pos,
		content: 'Location found using HTML5.'
		});*/
		
		map.setCenter(pos);
		}, function() {
		handleNoGeolocation(true);
		});
	} else {
		// Browser doesn't support Geolocation
		handleNoGeolocation(false);
	}
	
	areaLayer = new google.maps.FusionTablesLayer({
		query: {
			select: 'geometry',
			from: areaTableName
		},
	});
	areaLayer.setMap(map);
	
	//dotsLayer = new google.maps.FusionTablesLayer({	
	//	query: {
	//		select: 'geoname, longitude, latitude',
	//		from: dotsTableName,
	//		where: 'latitude != "" AND longitude != ""'
	//	},
	//	heatmap: {
	//		enabled: $("#heatmap").is(":checked")
	//	},
	//});
	//dotsLayer.setMap(map);
	
}

function handleNoGeolocation(errorFlag) {
	if (errorFlag) {
		var content = 'Error: The Geolocation service failed.';
	} else {
		var content = 'Error: Your browser doesn\'t support geolocation.';
	}
	var options = {
		map: map,
		position: new google.maps.LatLng(60, 105),
		content: content
	};
	var infowindow = new google.maps.InfoWindow(options);
	map.setCenter(options.position);
}

google.maps.event.addDomListener(window, 'load', initialize);

$(document).ready(function () {
	$('#provincias select:first').attr('disabled', 'disabled');
	
	queryTable(
		"SELECT nom_dep FROM TABLE GROUP BY nom_dep",
		areaTableName,
		function(data) {
			if (populateSelect(parseJason(data), '#departamentos')) {
				$('#departamentos').trigger('change');
			}
		}
	);
	
	$('#departamentos').change(function() {
		var selectedValue = $(this).find('option:selected').val();
		
		if (selectedValue != '') {
			queryTable(
				"SELECT nom_prov FROM TABLE WHERE nom_dep = '" + selectedValue + "' GROUP BY nom_prov",
				areaTableName,
				function(data) {
					if (populateSelect(parseJason(data), '#provincias select:first')) {
						$('#provincias select:first').removeAttr('disabled');
						areaLayer.setOptions({
							query: {
								select: 'geometry',
								from: areaTableName,
								where: "nom_dep = '" + selectedValue + "'"
							}
						});
					}
				}
			);
		}	
	});
	
	$("#layer").click(function() {
		areaLayer.setMap(($(this).is(":checked") ? map : null));
	});
	
}); //MT: end $(document).ready()
</script>
<div class="span3">
	<label for="map_layer">Ver capa: <input type="checkbox" id="layer" checked="checked"></label>
	<br />
	<label for="map_departamentos">Departamentos:</label>
	<select name="map_departamentos" id="departamentos"></select>
	<div id="provincias">
		<label for="map_provincias">Provincias:</label>
		<select name="map_provincias"></select>
	</div>
	<button class="btn btn-large btn-primary" type="button" onclick="">Buscar</button>
	<!--
	<label for="map_layers">Capas:</label>
	<select name="map_layers" id="layers">
		<option value="all">Todas</option>
		<option value="dots">Puntos</option>
		<option value="area">Área</option>
	</select>
	<label for="map_heatmap">Heatmap:</label>
	<input type="checkbox" name="map_heatmap" id="heatmap">
	-->
	
</div>
<div class="span8 pull-right" style="height: 100%">
	<div id="map_canvas"></div>
</div>
<script type="text/javascript">
	$("#layers").change(function() {
		switch($(this).find("option:selected").val()) {
			case 'all': {
				dotsLayer.setMap(map);
				areaLayer.setMap(map);
				break;
			}
			case 'dots': {
				dotsLayer.setMap(map);
				areaLayer.setMap(null);
				break;
			}
			case 'area': {
				dotsLayer.setMap(null);
				areaLayer.setMap(map);
				break;
			}
		}
	});
	
	//$.ajax({
	//	async: true,
	//	//dataType: "json",
	//	url: "https://www.googleapis.com/fusiontables/v1/query?sql=SELECT+geoname,%20longitude,%20latitude+FROM+" + dotsTableName + "&key=AIzaSyB1EjUV_8Lmq6YkAQ04jwRttfGft94bXX0",
	//	success: function(data, textStatus) {
	//		if (data != "") {
	//			try {
	//				var result = $.parseJSON(data);
	//				var isJSON = true;
	//			} catch (e) {
	//				var isJSON = false;
	//			}
	//			
	//			if (isJSON) {
	//				$.each(result.rows, function(i, point) {
	//					/*marker = new google.maps.Marker({
	//						map: map,
	//						draggable: true,
	//						animation: google.maps.Animation.DROP,
	//						position: new google.maps.LatLng(point.lat, point.lng)
	//					});*/
	//					console.log(point);
	//				});
	//			}
	//		}
	//	}
	//});
</script>