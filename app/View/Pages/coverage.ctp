
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	
    <script type="text/javascript">
		
		google.load("visualization", "1", {packages:["corechart","geochart"]});
		

	
		function getTable(country, indicator, countryname , callback) {
			$.getJSON("http://api.worldbank.org/countries/"+country+"/indicators/"+indicator+"?date=1990:2010&format=jsonp&per_page=250&prefix=?&callback=?", 
				function(jsondata){
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Year');
					data.addColumn('number', countryname);
					$.each(jsondata[1], function(i,item){
						data.addRow([item.date,Number(item.value)]);
						//console.log(item.date,item.value);
					});
					
					data.sort({column: 1, desc: false}); 
		  
					console.log(1);
					return callback(data);
				}
			);
		}
		function drawChart(country, countryname, indicators, indicatorname) {
			
			$.getJSON("http://api.worldbank.org/countries/"+country+"?format=jsonp&prefix=?&callback=?",
					  
			function(countrydata){
				
				console.log();
				
				regionId = countrydata[1][0].region.id;
				regionName = countrydata[1][0].region.value;
				
				getTable(country, indicators[0], countryname,
					function(data){
						
						getTable(regionId,indicators[0],regionName,
							function(dataregion){
								
								getTable(regionId, indicators[1],countryname+' Rural',
									
									
									function(datarural){
										
										getTable(regionId, indicators[2],countryname+' Urbano',
												 
											function(dataurbana){
												var options = {
													backgroundColor: '#2298C6',
													hAxis:{textStyle: {color: 'white', fontSize: 15}},
													vAxis:{textStyle: {color: 'white', fontSize: 18}},
													legend:{textStyle: {color: 'white', fontSize: 15}},
													lineWidth: 8,
													chartArea:{left:40,top:20,width:"70%",height:"70%"},
													colors: ['#CAFF42','#0B486B','#79BD9A','#3B8686']

												};
											
												datajoin1 = google.visualization.data.join(data, dataregion, 'inner', [[0,0]], [1], [1]);
												datajoin2 = google.visualization.data.join(datajoin1, datarural, 'inner', [[0,0]], [1,2], [1]);
												datajoin3 = google.visualization.data.join(datajoin2, dataurbana, 'inner', [[0,0]], [1,2,3], [1]);
												
												var chart = new google.visualization.LineChart(document.getElementById(indicators[0]));
												chart.draw(datajoin3, options);
											}
										);
									}
								);
							}
						);

					}
				);
				
			});
		}
	  
	  
	  
	  function drawCharts(countrycode, countryname ){
		
		drawChart(countrycode,countryname,['SH.H2O.SAFE.ZS','SH.H2O.SAFE.RU.ZS','SH.H2O.SAFE.UR.ZS'],'');
		drawChart(countrycode,countryname,['SH.STA.ACSN','SH.STA.ACSN.RU','SH.STA.ACSN.UR'],'');

	  }
	  
	  $(document).ready(function() {
		
		$(".hash").click(function(event) {
			editAnchor(event, this);
		});	
		
		$.getJSON("http://api.worldbank.org/countries?per_page=250&format=jsonp&prefix=?&callback=?",
		
		function (jsondata){
		  $.each(jsondata[1], function(i,item){
			
			if(item.region.value!="Aggregates"){
			  
			  if(item.iso2Code=='BO')
				selected = 'selected';
			  else
				selected = '';
			  var itemval= '<option value="'+item.iso2Code+'" '+selected+' >'+item.name+'</option>';
			  $("#country").append(itemval);
			}            
		  });
	
		});
	
		drawCharts('BO','Bolivia');
		drawGlobe('SH.H2O.SAFE.RU.ZS','2010');
		$("#country").change(function() 
		{
			countrycode = $('#country').attr('value');
			countryname = $('#country option[value='+$('#country').attr('value')+']').text();
			//drawChart($('#country').attr('value'),$('#yearmap').attr('value'));
			drawCharts(countrycode,countryname);
		});
		
      });
    </script>

<?php echo $this->element('explore_menu',  array('menu' => 'coverage')); ?>

<div style="background-color:  #2298C6; min-height:500px; text-color:#ffffff; box-shadow: 0 3px 2px rgba(0, 0, 0, 0.15);" >
	<div class="container-fluid" >
	<div class="row-fluid">
	  <div class="span12" style="min-height:5	0px; padding-top:20px;">
		<p class="lead span4 offset3" style="color:#fff; font-size:200%" id="pais">Cobertura en tu país </p>
		<select id="country" name="country">
			<option value="BO">Bolivia </option>
		</select>
	  </div>
	</div>
	
	<div class="row-fluid">
		<div class="span6" style="text-align: center;">
			<h3 style="color:#fff; "> Fuentes de agua mejorada <small> (% de la poblacion con acceso)</small></h3>
		</div>
		<div class="span6" style="text-align: center;">
			<h3 style="color:#fff; font-size:200%">Puntos saneamiento mejorados <small> (% de la poblacion con acceso)</small></h3>

		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div id="SH.H2O.SAFE.ZS" style="height: 400px;" >
			</div>
		</div>
		<div class="span6">
			<div id="SH.STA.ACSN" style="height: 400px;" ></div>
		</div>
	</div>
	
	<div class="row-fluid">
	  <div class="span12">
		<small>Fuente: World Bank</small>
	  </div>
	</div>
	</div>
</div>