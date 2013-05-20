<style type="text/css">
	#map_canvas { height: 500px; }
</style>
<script type="text/javascript">
var map;
var dotsTableName = '1CBwJa2c74oTqV_IST8Viim0CFZofe9qAwZCDsT8';
var areaTableName = '1IW43AblTgBE6OGz79hqMjq3yv_saG88OuE4pBJk';
var flowTableName = '1dUSqdHV-nAFpmMaIP9-4ekKAePvwWdEehPcHQyk';
//var areaTableName = '1ZT5rrWyUSAmJBJim-FaMBxwrG6CpcmI5TYAsm3Y';
var apiKey = 'AIzaSyB1EjUV_8Lmq6YkAQ04jwRttfGft94bXX0';

var dotsLayer = null;
var areaLayer = null;
var flowLayer = null;
var infowindow;
var infowindow2;


function initialize() {
	var mapOptions = {
		zoom: 6,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
	
	map.setCenter(new google.maps.LatLng(-17.8, -63.16667));
	
	areaLayer = new google.maps.FusionTablesLayer({
		query: {
			select: 'poblacion',
			from: areaTableName
		},
	});
	areaLayer.setMap(map);
	
	//applyStyle(map, areaLayer, $('#municipios_params select:first').find('option:selected').val());
	flowLayer = new google.maps.FusionTablesLayer({	
        query: {
            select: 'latitude',
            from: '1dUSqdHV-nAFpmMaIP9-4ekKAePvwWdEehPcHQyk'
        }
		,
		suppressInfoWindows: true,
        styles: [{
            where: "markType = 'WATER_POINT'",
            markerOptions: {
                iconName: 'ltblu_blank'
            }},
            {
            where: "markType = 'PUBLIC_INSTITUTION'",
            markerOptions: {
                iconName: 'museum'
            }},
            {
            where: "markType = 'SCHOOL'",
            markerOptions: {
                iconName: 'schools'
            }}]
	});
	flowLayer.setMap(map);

		google.maps.event.addListener(flowLayer, 'click', function(e) {
if(infowindow2) infowindow2.close();
else infowindow2 = new google.maps.InfoWindow();

    //create info window layer
    infoWindowContent2 = infowindow2.setContent(
        "<div class='googft-info-window' style='font-family: sans-serif'>"+
"<b>type:</b> "+e.row['markType'].value+"<br>"+
"</div>");
    infowindow2.setPosition(e.latLng);
    map.setCenter(e.latLng);
    infowindow2.open(map);        
});
		
	dotsLayer = new google.maps.FusionTablesLayer({	
		query: {
			select: 'geoname, longitude, latitude',
			from: dotsTableName,
			//where: 'mjsector_1 = "Water, sanitation and flood protection"',
			//where: 'latitude != "" AND longitude !=""',
			//where: "mjsector_1 = 'Water, sanitation and flood protection'"
			//where: "mjsector_1 = 'Water, sanitation and flood protection' AND latitude != '' AND longitude != ''"
		},
		suppressInfoWindows: true
		/*,
		styles: [{
			markerOptions: {
				iconName: 'blu_blank'
			}}
		]*/
	});

	var mc = new MarkerClusterer(map);
	
	dotsLayer.setMap(map);
	
	google.maps.event.addListener(dotsLayer, 'click', function(e) {
if(infowindow) infowindow.close();
else infowindow = new google.maps.InfoWindow();

    //create info window layer
    infoWindowContent = infowindow.setContent(
        "<div class='googft-info-window' style='font-family: sans-serif'>"+
"<b>project title:</b> "+e.row['project title'].value+"<br>"+
"<b>project sector:</b> "+e.row['mjsector_1'].value+"<br>"+
"<b>country:</b> "+e.row['country'].value+"<br>"+
"<b>adm1:</b> "+e.row['adm1'].value+" <br>"+
"<b>adm2:</b> "+e.row['adm2'].value+"<br>"+
"<b>geoname:</b> "+e.row['geoname'].value+"<br>"+
"<b>development objective:</b> "+e.row['development objective'].value+"<br>"+
"<b>description:</b> <a href='"+e.row['notes'].value+"' target='_blank'>"+e.row['description'].value+"</a><br>"+
"<b>notes:</b> <a href='"+e.row['project title'].value+"' target='_blank'>"+e.row['notes'].value+"</a><br>"+
"<b>results:</b> "+e.row['results'].value+"<br>"+
"<b>product line:</b> "+e.row['product line'].value+"<br>"+
"<b>notes/documentation:</b> <a href='"+e.row['notes/documentation'].value+"' target='_blank'>"+e.row['notes/documentation'].value+"</a><br>"+
"</div>");

    infowindow.setPosition(e.latLng);
    map.setCenter(e.latLng);
    infowindow.open(map);        
});
	
}

google.maps.event.addDomListener(window, 'load', initialize);

$(document).ready(function () {
	$('#provincias select:first').attr('disabled', 'disabled');
	$('#municipios select:first').attr('disabled', 'disabled');
	
	queryTable(
		"SELECT nom_dep FROM TABLE GROUP BY nom_dep",
		areaTableName,
		apiKey,
		function(data) {
			if (populateSelect(parseJason(data), '#departamentos', '--- Todos ---')) {
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
				apiKey,
				function(data) {
					areaLayer.setOptions({
						query: {
							select: 'geometry',
							from: areaTableName,
							where: "nom_dep = '" + selectedValue + "'"
						}
					});
				}
			);
		} else {
			areaLayer.setOptions({
				query: {
					select: 'geometry',
					from: areaTableName,
				}
			});
		}
	});
	
	$('#provincias select:first').change(function() {
		var selectedValue = $(this).find('option:selected').val();
		
		if (selectedValue != '') {
			queryTable(
				"SELECT CODIGO, nom_mun FROM TABLE WHERE nom_prov = '" + selectedValue + "'",
				areaTableName,
				apiKey,
				function(data) {
					if (populateSelect(parseJason(data), '#municipios select:first')) {
						$('#municipios select:first').removeAttr('disabled');
						areaLayer.setOptions({
							query: {
								select: 'geometry',
								from: areaTableName,
								where: "nom_prov = '" + selectedValue + "'"
							}
						});
					}
				}
			);
		}	
	});
	
	$('#municipios select:first').change(function() {
		var selectedValue = $(this).find('option:selected').val();
		
		if (selectedValue != '') {
			areaLayer.setOptions({
				query: {
					select: 'geometry',
					from: areaTableName,
					where: "CODIGO = '" + selectedValue + "'"
				}
			});
		}	
	});
	
	$('#municipios_params select:first').change(function() {
		var selectedValue = $(this).find('option:selected').val();
		
		if (selectedValue != '') {
			applyStyle(map, areaLayer, selectedValue);
			$(".mapLegend").hide();
			$("#legend_" + selectedValue).show();
		}	
	});
	
	$("#area_layer").click(function() {
		areaLayer.setMap(($(this).is(":checked") ? map : null));
	});
	
	$("#dots_layer").click(function() {
		dotsLayer.setMap(($(this).is(":checked") ? map : null));
	});
	
	$("#flow_layer").click(function() {
		flowLayer.setMap(($(this).is(":checked") ? map : null));
	});
	
}); //MT: end $(document).ready()
</script>
<div class="row-fluid">
	<div class="span4">
		<h3 id="el_mapa">Search the map</h3>
		<label><input type="checkbox" id="dots_layer" checked="checked">
		<!--<img src="http://www.gsshealth.com/communities/2/004/008/922/932/images/4544352476_35x35.png" width=24>-->
		World Bank Projects</label>
		<label><input type="checkbox" id="flow_layer" checked="checked">
		Data WaterForPeople.org</label>
		<br>
		<label><input type="checkbox" id="area_layer" checked="checked">Water and sanitation indicators "Municipios:</label>
		<small>Source: <a href="http://www.mmaya.gob.bo/" target="_blank">http://www.mmaya.gob.bo/</a></fuente>

		
		<h5>Water and sanitation indicators</h5>
		<label for="map_departamentos">Departamentos:</label>
		<select name="map_departamentos" id="departamentos"></select>
		<div id="municipios_params">
			<label for="map_municipios_params">Indicators:</label>
			<select name="map_municipios_params">
				<option value="poblacion" selected="selected">Population</option>
				<option value="cob_ap">Cobertura agua potable</option>
				<option value="cob_san">Cobertura saneamiento</option>
				<option value="calc_iaris">Calculo IARIS</option>
				<option value="categ_iaris">categoria IARIS</option>
			</select>
		</div>
		
		<div id="municipios_legends" class="mapLegendContainer well"></div>
		<!--
		<div id="provincias">
			<label for="map_provincias">Provincias:</label>
			<select name="map_provincias"></select>
		</div>
		<div id="municipios">
			<label for="map_municipios">Municipios:</label>
			<select name="map_municipios"></select>
		</div>
		-->
		<div class="alert alert-info">
			<a class="close" data-dismiss="alert" href="#">&times;</a>
			For the moment  the map only shows data for Bolivia. 
			<strong>Soon new countries will be available.</strong>
		</div>
	</div>
	<div class="span8 pull-right" style="height: 100%">
		<div id="map_container" style="margin-right: 20px;">
			<div id="map_canvas"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	var mapContainer = $("#map_container");
    
    function adjustMap() {
        var maxHeight = $(window).height() - mapContainer.offset().top - 16;
		mapContainer.height(maxHeight);
    }
	
	var layerStyles = {
		'poblacion': [
			{
				'min': 0,
				'max': 1000,
				'color': '#FFD699'
			},
			{
				'min': 1000,
				'max': 10000,
				'color': '#FFC166'
			},
			{
				'min': 10000,
				'max': 500000,
				'color': '#FFAD33'
			},
			{
				'min': 500000,
				'max': 1000000,
				'color': '#FF9900'
			}
		],
		'cob_ap': [
			{
				'min': 0,
				'max': 20,
				'color': '#CCEAFF'
			},
			{
				'min': 20,
				'max': 40,
				'color': '#99D6FF'
			},
			{
				'min': 40,
				'max': 60,
				'color': '#66C1FF'
			},
			{
				'min': 60,
				'max': 80,
				'color': '#33ADFF'
			},
			{
				'min': 80,
				'max': 100,
				'color': '#0099FF'
			}
		],
		'cob_san': [
			{
				'min': 0,
				'max': 20,
				'color': '#99EA99'
			},
			{
				'min': 20,
				'max': 40,
				'color': '#99EA99'
			},
			{
				'min': 40,
				'max': 60,
				'color': '#66E066'
			},
			{
				'min': 60,
				'max': 80,
				'color': '#33D633'
			},
			{
				'min': 80,
				'max': 100,
				'color': '#00CC00'
			}
		],
		'calc_iaris': [
			{
				'min': 0.1,
				'max': 0.3,
				'color': '#CCEAFF'
			},
			{
				'min': 0.3,
				'max': 0.5,
				'color': '#99D6FF'
			},
			{
				'min': 0.5,
				'max': 0.7,
				'color': '#66C1FF'
			},
			{
				'min': 0.7,
				'max': 0.9,
				'color': '#33ADFF'
			},
			{
				'min': 0.9,
				'max': 1,
				'color': '#0099FF'
			}
		],
		'categ_iaris': [
			{
				'min': 0,
				'max': 1,
				'color': '#CCEAFF'
			},
			{
				'min': 1,
				'max': 2,
				'color': '#99D6FF'
			},
			{
				'min': 2,
				'max': 3,
				'color': '#66C1FF'
			},
			{
				'min': 3,
				'max': 4,
				'color': '#33ADFF'
			},
			{
				'min': 4,
				'max': 5,
				'color': '#0099FF'
			}
		],
	}
	
	for (var i in layerStyles) {
		var listItems = '<ul id="legend_' + i + '" class="mapLegend noStyle">';
		listItems += '<li class="legendTitle">' + i + '</li>';
		for(var style in layerStyles[i]) {
			listItems += '<li><span class="legendColor" style="background-color: ' + layerStyles[i][style].color + ';"></span> ' + layerStyles[i][style].min + ' - ' + layerStyles[i][style].max + '</li>';
		}
		listItems += '</ul>';
		$("#municipios_legends").append(listItems);
	}
	
	$(".mapLegend").hide();
	$("#legend_" + $('#municipios_params select:first').find('option:selected').val()).show();
	
	function applyStyle(map, layer, column) {
		var columnStyle = layerStyles[column];
		var styles = [];
		
		for (var i in columnStyle) {
			var style = columnStyle[i];
			styles.push({
				where: generateWhere(column, style.min, style.max),
				polygonOptions: {
					fillColor: style.color,
					fillOpacity: style.opacity ? style.opacity : 0.8
				}
			});
		}
		
		layer.set('styles', styles);
	}
	
	function generateWhere(columnName, low, high) {
		var whereClause = [];
		whereClause.push("'");
		whereClause.push(columnName);
		whereClause.push("' >= ");
		whereClause.push(low);
		whereClause.push(" AND '");
		whereClause.push(columnName);
		whereClause.push("' < ");
		whereClause.push(high);
		return whereClause.join('');
	}
    
    //adjustMap();
    //
    //$(window).resize(function() {
    //    adjustMap();
    //});
	
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