<style type="text/css">
	#map_canvas { height: 500px; }
</style>
<script type="text/javascript">
var map;
var dotsTableName = '1CBwJa2c74oTqV_IST8Viim0CFZofe9qAwZCDsT8';
var areaTableName = '1IW43AblTgBE6OGz79hqMjq3yv_saG88OuE4pBJk';
//var areaTableName = '1ZT5rrWyUSAmJBJim-FaMBxwrG6CpcmI5TYAsm3Y';
var apiKey = 'AIzaSyB1EjUV_8Lmq6YkAQ04jwRttfGft94bXX0';

var dotsLayer = null;
var areaLayer = null;

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
	
	applyStyle(map, areaLayer, $('#municipios_params select:first').find('option:selected').val());
	
	dotsLayer = new google.maps.FusionTablesLayer({	
		query: {
			select: 'geoname, longitude, latitude',
			from: dotsTableName,
			//where: 'mjsector_1 = "Water, sanitation and flood protection"',
			//where: 'latitude != "" AND longitude !=""',
			//where: "mjsector_1 = 'Water, sanitation and flood protection'"
			//where: "mjsector_1 = 'Water, sanitation and flood protection' AND latitude != '' AND longitude != ''"
		},
		style: {
			iconName: 'blu_blank'
		}
	});
	dotsLayer.setMap(map);
	
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
	
}); //MT: end $(document).ready()
</script>
<div class="span3">
	<div class="alert alert-info">
	Actualmente el mapa solo se despliega para Bolivia. Esto para demostrar el concepto y disponibilidad de los datos. <strong>Pronto se tendrán nuevos paises.</strong>
	</div>
	<fieldset>
		<label><input type="checkbox" id="dots_layer" checked="checked"> Proyectos del Banco Mundial</label>
	</fieldset>
	
		<label><input type="checkbox" id="area_layer" checked="checked"> Municipios del país</label>
	<fieldset>
		<h5>Índices</h5>
		
		<label for="map_departamentos">Departamentos:</label>
		<select name="map_departamentos" id="departamentos"></select>
		<div id="municipios_params">
			<label for="map_municipios_params">Índices:</label>
			<select name="map_municipios_params">
				<option value="poblacion" selected="selected">Población</option>
				<option value="cob_ap">Cobertura agua potable</option>
				<option value="cob_san">Cobertura saneamiento</option>
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
	</fieldset>
</div>
<div class="span8 pull-right" style="height: 100%">
	<div id="map_container" style="margin-right: 20px;">
		<div id="map_canvas"></div>
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