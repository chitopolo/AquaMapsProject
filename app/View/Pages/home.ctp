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

		
		/*drawChart(countrycode,countryname,'SH.H2O.SAFE.RU.ZS','Improved water source, rural (% of rural population with access)');
		drawChart(countrycode,countryname,'SH.H2O.SAFE.UR.ZS','Improved water source, urban (% of urban population with access)');
		drawChart(countrycode,countryname,'SH.H2O.SAFE.ZS','Improved water source (% of population with access)');
		
		drawChart(countrycode,countryname,'SH.STA.ACSN.RU','Improved sanitation facilities, rural (% of rural population with access)');
		drawChart(countrycode,countryname,'SH.STA.ACSN.UR','Improved sanitation facilities, urban (% of urban population with access)');
		drawChart(countrycode,countryname,'SH.STA.ACSN','Improved sanitation facilities (% of population with access)');*/

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
		
		$('a[data-toggle="pill"]').on('shown', function (e) {
			console.log(e.target.name); // activated tab
			$('#mapindicator').attr('value',e.target.name);
			drawGlobe(e.target.name,'2010');
		});

      });
    </script>

<!-- RP: Start Blue Space -->
<div style="background-color:  #2298C6; min-height:500px; text-color:#ffffff; box-shadow: 0 3px 2px rgba(0, 0, 0, 0.15);" >
	<div class="container-fluid" >
	<div class="row-fluid">
	  <div class="span12" style="min-height:5	0px; padding-top:20px;">
		<p class="lead span4 offset3" style="color:#fff; font-size:200%" id="pais">Water in your country </p>
		<select id="country" name="country">
			<option value="BO">Bolivia </option>
		</select>
	  </div>
	</div>
	
	<div class="row-fluid">
		<div class="span6" style="text-align: center;">
			<h3 style="color:#fff; "> Improved water source <small> (% of population with access)</small></h3>
		</div>
		<div class="span6" style="text-align: center;">
			<h3 style="color:#fff; font-size:200%">Improved sanitation facilities <small> (% of population with access)</small></h3>

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
		<small>Source: World Bank</small>
	  </div>
	</div>
	</div>
</div>
<div style="min-height: 500px; padding: 20px 0;">
	<?php echo $this->element('main_map'); ?>
</div>





<!-- RP: Ends Blue Space -->



<div style="background-color:  #2298C6; text-color:#ffffff" >
	<div class="container-fluid" >
		<div class="row-fluid">
		
		
			<div class="span12" style="min-height:500px; margin-top:100px;">
			<h2 id="ayudar" style="color:white;">How can you help?</h2>
		<ul class="thumbnails">
  <li class="span3">
    <div class="img-rounded">
    <?php   echo $this->Html->image('person.png', array('class' => 'media-object', 'width' => 300));  ?>
      <h3  style="color:white;">Collect informacion</h3>
      <p  style="color:white;"> If you are part of an organization that works with santitation and water projects. And even if your a indvidual that is traveling. You can help us by collect data with your mobile app.</p>
    </div>
  </li>
<li class="span3">
    <div class="img-rounded">
      <?php   echo $this->Html->image('person.png', array('class' => 'media-object', 'width' => 300));  ?>

      <h3  style="color:white;">Share</h3>
      <p  style="color:white;">You can share this informatin with world</p>
    </div>
  </li>
<li class="span3">
    <div class="img-rounded">
     <?php   echo $this->Html->image('person.png', array('class' => 'media-object', 'width' => 300));  ?>

      <h3  style="color:white;">Register</h3>
      <p  style="color:white;"> You can register here. (son it will be open).
</p>
    </div>
  </li>

<li class="span3">
    <div class="img-rounded">
     <?php   echo $this->Html->image('person.png', array('class' => 'media-object', 'width' => 300));  ?>

      <h3  style="color:white;">Download our app </h3>
      <p  style="color:white;">  <?php echo $this->Html->link(__('Mobile application'), '/Pages/mobile', array('style'=>'color:white;') ); ?>

	  <!--
	  <a href="http://aquamaps.cochavalley.com/files/presentacion_%20AquaMaps.pptx" target="_blank" style="color: white;">
	  
	  <strong> Ve mas aqui</strong>

	  </a>
	  	  	  -->

</p>
    </div>
  </li>
</ul>
			</div>
		</div>
	</div>
</div>





<!-- RP: Start White Space -->
<div style=" min-height:500px;" >
  <div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<h3 id="mundo">Global Data:</h3>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<ul class="nav nav-pills nav-stacked">
				<li class="nav-header">
				  Sanitation
				</li>
				<li class="active"><a href="" name="SH.H2O.SAFE.RU.ZS" data-toggle="pill">Fuente de agua mejorada, RURAL</a></li>
				<li><a href="" name="SH.H2O.SAFE.UR.ZS" data-toggle="pill">Fuente de agua mejorada, URBANA</a></li>
				<li><a href="" name="SH.H2O.SAFE.ZS" data-toggle="pill">Fuente de agua mejorada, TOTAL</a></li>
				<li><a href="" name="SH.STA.ACSN.RU" data-toggle="pill">Instalaciones de sanidad mejoradas, RURAL</a></li>
				<li><a href="" name="SH.STA.ACSN.RU" data-toggle="pill">Instalaciones de sanidad mejoradas, URBANA</a></li>
				<li><a href="" name="SH.STA.ACSN.RU" data-toggle="pill">Instalaciones de sanidad mejoradas, TOTAL</a></li>
				<li class="nav-header">Indicadores SocioEconomicos</li>
				<li><a href="" name="SP.POP.TOTL" data-toggle="pill">Población rural</a></li>
				<li><a href="" name="SP.POP.TOTL" data-toggle="pill">Población urbana</a></li>
				<li><a href="" name="SP.POP.TOTL" data-toggle="pill">Población total</a></li>
			  </ul>
		</div>
		<div class="span8" id="globe">
		</div>
	</div>
	<div class="row-fluid">
	  <div class="span12">
		<small>Source: World Bank. 2010</small>
	  </div>
	</div>
  </div>
</div>

<!-- RP: Start Blue Space -->
<div style="background-color:  #2298C6; min-height:100px; color:#ffffff" >
	<div class="container" >
	  <div class="row">
		  <div class="span12" style="min-height:100px; padding-top:20px;">
		  </div>
	  </div>
	</div>
</div>




