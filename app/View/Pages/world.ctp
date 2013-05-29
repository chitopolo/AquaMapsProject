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
	
	

	  
	  $(document).ready(function() {
		

		drawGlobe('SH.H2O.SAFE.RU.ZS','2010');
		
		$('a[data-toggle="pill"]').on('shown', function (e) {
			console.log(e.target.name); // activated tab
			$('#mapindicator').attr('value',e.target.name);
			drawGlobe(e.target.name,'2010');
		});

      });
    </script>

<?php echo $this->element('explore_menu',  array('menu' => 'world')); ?>


<div>
  <div class="container-fluid">

	<div class="row-fluid">
		<div class="span4">
		<h3 id="mundo">Datos globales:</h3>

			<ul class="nav nav-pills nav-stacked">
				<li class="nav-header">
				  Saneamiento
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
		<small>Fuente: World Bank. 2010</small>
	  </div>
	</div>
  </div>
</div>