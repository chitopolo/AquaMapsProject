<script>
var map;
var dotsTableName = '1fi7TpPzqakAfgrWWe-OWAOKZE_WLe1eIVl87q2o';
var areaTableName = '1ZT5rrWyUSAmJBJim-FaMBxwrG6CpcmI5TYAsm3Y';

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
	
	dotsLayer = new google.maps.FusionTablesLayer({	
		query: {
			select: 'geoname, longitude, latitude',
			from: dotsTableName,
			where: 'latitude != "" AND longitude != ""'
		},
		heatmap: {
			enabled: $("#heatmap").is(":checked")
		},
	});
	dotsLayer.setMap(map);
	
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
	
	$("#heatmap").click(function() {
		dotsLayer.setOptions({
			heatmap: {
				enabled: $(this).is(":checked")
			}
		});
	});
});

</script>
<div class="span2">
	<label for="map_layers">Capas:</label>
	<select name="map_layers" id="layers">
		<option value="all">Todas</option>
		<option value="dots">Puntos</option>
		<option value="area">Área</option>
	</select>
	
	<label for="map_heatmap">Heatmap:</label>
	<input type="checkbox" name="map_heatmap" id="heatmap">
</div>
<div class="span9" style="height: 100%">
	<div id="map_canvas"></div>
</div>
<script type="text/javascript">
	
	//MT: get data
	
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