 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	
    <script type="text/javascript">
		
		google.load("visualization", "1", {packages:["corechart","geochart"]});
		
		function drawGlobe(index,year) {
		
			//$('#titlemap').html('<img align="center" src="'+base_url+'img/ajax-loader.gif">');
			$('#globe').html('');
			
			$.getJSON("http://api.worldbank.org/countries/all/indicators/"+index+"?date="+year+"&format=jsonp&per_page=250&prefix=?&callback=?", 
			  
			  function(jsondata){

	  
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Country');
				data.addColumn('number', 'value');
	  
				
				$.each(jsondata[1], function(i,item){
				  //if(jQuery.inArray(item.country.id,aggregates) == -1){
					data.addRow([item.country.value,Number(item.value)]);
				  //}            
				});
			  
				var geochart = new google.visualization.GeoChart(
				  document.getElementById('globe'));
	  
	  
				var options = {
					width: 600, 
					height: 600,
					title: jsondata[1][0].indicator.value
				};
				geochart.draw(data,options );
				//$('#titlemap').html(jsondata[1][0].indicator.value+' '+'('+year+')');
			});
		}
	
	
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
													title: ''
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

		
		/*drawChart(countrycode,countryname,'SH.H2O.SAFE.RU.ZS','Improved water source, rural (% of rural population with access)');
		drawChart(countrycode,countryname,'SH.H2O.SAFE.UR.ZS','Improved water source, urban (% of urban population with access)');
		drawChart(countrycode,countryname,'SH.H2O.SAFE.ZS','Improved water source (% of population with access)');
		
		drawChart(countrycode,countryname,'SH.STA.ACSN.RU','Improved sanitation facilities, rural (% of rural population with access)');
		drawChart(countrycode,countryname,'SH.STA.ACSN.UR','Improved sanitation facilities, urban (% of urban population with access)');
		drawChart(countrycode,countryname,'SH.STA.ACSN','Improved sanitation facilities (% of population with access)');*/

	  }
	  
	  $(document).ready(function(){
		drawCharts('BO','Bolivia');
		drawGlobe('SH.H2O.SAFE.RU.ZS','2010');
		$("#country").change(function() 
		{
		
			countrycode = $('#country').attr('value');
			countryname = $('#country option[value='+$('#country').attr('value')+']').text();
			//drawChart($('#country').attr('value'),$('#yearmap').attr('value'));
			drawCharts(countrycode,countryname);

		});
		
		$('a[data-toggle="pill"]').on('shown', function (e) {
			console.log(e.target.name); // activated tab
			$('#mapindicator').attr('value',e.target.name);
			drawGlobe(e.target.name,'2010');
		});

      });
    </script>

<!-- RP: Start Blue Space -->
<div style="background-color:  #2298C6; min-height:500px; text-color:#ffffff" >
<div class="container-fluid" >
<div class="row-fluid">
  <div class="span12" style="min-height:5	0px; padding-top:20px;">
	<h1 style="color:#fff;">El agua en tu pa&iacute;s: </h1>
	<select id="country" name="country">
		<option value="BO">Bolivia </option>
		<option value="BI">Burundi </option>
	</select>
  </div>
</div>

<div class="row-fluid">
	<div class="span6">
		<h3 style="color:#fff;">Cobertura agua (% de la poblaci&oacute;n)</h3>
	</div>
	<div class="span6">
		<h3 style="color:#fff;">Cobertura saneamiento (% de la poblaci&oacute;n)</h3>
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



	
  <div class="span12" style="min-height:100px; padding-top:20px; padding-bottom:40px;">
  <h1 tyle="color:#fff;">Aqui mapa</h1>
  <iframe width="940" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?ie=UTF8&amp;ll=-16.520366,-64.621582&amp;spn=12.720779,23.928223&amp;t=m&amp;z=7&amp;output=embed"></iframe><br />
  </div>

<!---

<div class="span12">
<ul class="thumbnails">
  <li class="span3">
    <a href="#" class="cirlcle">
     <?php   echo $this->Html->image('people.png', array('class' => 'media-object', 'width' => 260));  ?>
    </a>
  </li>
  <li class="span3">
    <a href="#" class="cirlcle">
      <?php   echo $this->Html->image('people.png', array('class' => 'media-object', 'width' => 260));  ?>
    </a>
  </li>
   <li class="span3">
    <a href="#" class="circle">
      <?php   echo $this->Html->image('people.png', array('class' => 'media-object', 'width' => 260));  ?>
    </a>
  </li>
  </li>
   <li class="span3">
    <a href="#" class="circle">
      <?php   echo $this->Html->image('people.png', array('class' => 'media-object', 'width' => 260));  ?>    </a>
  </li>
</ul>
</div>

--->



</div>

</div>


<!-- RP: Ends Blue Space -->


<!-- RP: Start White Space -->



<div style="min-height:500px; color:#13576E" >
  <div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h2>El agua en el mundo</h2>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span3">
			<ul class="nav nav-pills nav-stacked">
				<li class="nav-header">
				  Saneamiento
				</li>
				<li class="active"><a href="" name="SH.H2O.SAFE.RU.ZS" data-toggle="pill">Improved water source, rural (% of rural population with access)</a></li>
				<li><a href="" name="SH.H2O.SAFE.UR.ZS" data-toggle="pill">Improved water source, urban (% of urban population with access)</a></li>
				<li><a href="" name="SH.H2O.SAFE.ZS" data-toggle="pill">Improved water source (% of population with access)</a></li>
				<li><a href="" name="SH.STA.ACSN.RU" data-toggle="pill">Improved sanitation facilities, rural (% of rural population with access)</a></li>
				<li><a href="" name="SH.STA.ACSN.UR" data-toggle="pill">Improved sanitation facilities, urban (% of urban population with access)</a></li>
				<li><a href="" name="SH.STA.ACSN" data-toggle="pill">Improved sanitation facilities (% of population with access)</a></li>
				<li class="nav-header">
				  Indicadores SocioEconomicos
				</li>
				<li>
				  <a href="" name="SP.POP.TOTL" data-toggle="pill">Total Population</a>
				</li>
				<li>
				  <a href="" name="SP.URB.TOTL" data-toggle="pill">Urban population</a>
				</li>
				<li>
				  <a href="" name="SP.URB.TOTL.IN.ZS" data-toggle="pill">Urban population (% of total)</a>
				</li>
			  </ul>
		</div>
		<div class="span7" id="globe">
		</div>
	</div>
  </div>
</div>

<!-- RP: Start Blue Space -->
<div style="background-color:  #2298C6; min-height:200px; color:#ffffff" >
	<div class="container" >
	  <div class="row">
		  <div class="span12" style="min-height:300px; padding-top:20px;">
		  </div>
	  </div>
	</div>
</div>



