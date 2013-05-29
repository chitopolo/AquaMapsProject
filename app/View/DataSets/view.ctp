    <script>
    $(function() {

		var values = [13, 4, 2];
		$('#sparkline1').sparkline(values, {
		    type: "pie",
		       width: '200px',
		        height: '200px',
		    tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
		    tooltipValueLookups: {
		        'offset': {
		            0: 'Si',
		            1: 'Si, pero hay muchos problemas con el proveedor del servicio',
		            2: 'No'
		        }
		    },
		});
		var values = [19,0];

		$('#sparkline2').sparkline(values, {
		    type: "pie",
		       width: '200px',
		        height: '200px',
		    tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
		    tooltipValueLookups: {
		        'offset': {
		            0: 'Si',
		            1: 'No'
		        }
		    },
		});

		var values = [18,1];

		$('#sparkline3').sparkline(values, {
		    type: "pie",
		       width: '200px',
		        height: '200px',
		    tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
		    tooltipValueLookups: {
		        'offset': {
		            0: 'Si',
		            1: 'No (no tengo baño en la casa)',
		            2: 'No (tengo otro tipo de baños, como ecológicos, etc)'
		        }
		    },
		});

		var values = [2,13,6,3];

		$('#sparkline4').sparkline(values, {
		    type: "bar",
		       width: '200px',
		        height: '200px',
		        barWidth: '30px',
		        colorMap: ["red", "green", "blue","orange"],
		    tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
		    tooltipValueLookups: {
		        'offset': {
		            0: 'la tomas así nomás',
		            1: 'la hierves antes de tomar',
		            2: 'la usas para cocinar',
		            3: 'no la tomas nunca'
		        }
		    },
		});


		var values = [13,6];

		$('#sparkline5').sparkline(values, {
		    type: "pie",
		       width: '200px',
		        height: '200px',
		    tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
		    tooltipValueLookups: {
		        'offset': {
		            0: 'Si',
		            1: 'No'
		        }
		    },
		});


    });
    </script>

<div class="dataSets view">
<h2><?php  echo $dataSet['DataSet']['name']."Nombre data set" ; ?></h2>

<h3>Resultados</h3>
<!-- Mapa -->
<div class="row">
	<div class="span8">
		

	</div>
	<div class="span4">
	</div>
</div>
<!-- Mapa -->


		<span id="sparkpie1">
      			
      	</span>

		<ul class="thumbnails challenges">
              <li class="span4">

				<a class="thumbnail" href="" style="text-align: center">
					<span id="sparkline1" >&nbsp;</span>
					<div class="caption" style="margin-top: 100px;">
						<h4> P1: 
							Tienes servicio de agua potable en tu casa las 24 hrs.?
						</h4>
					</div>
			    </a>

              </li>
              <li class="span4">
				<a class="thumbnail" href="" style="text-align: center">
					<span id="sparkline2">&nbsp;</span>
					<div class="caption">
						<h4> P2: 
Tienes servicio de alcantarillado conectado a tu casa?						</h4>
					</div>
			    </a>
              </li>
              <li class="span4">

				<a class="thumbnail" href="" style="text-align: center">
					<span id="sparkline3">&nbsp;</span>

					<div class="caption">
						<h4> P3: 
							Tienes baño(s) con flujo de agua en tu casa?
						</h4>
					</div>
			    </a>

              </li>
              <li class="span4">

				<a class="thumbnail" href="" style="text-align: center">
					<span id="sparkline4">&nbsp;</span>

					<div class="caption">
						<h4> P3: 
							El agua que sale de la pila...
						</h4>
					</div>
			    </a>

              </li>
              <li class="span4">
				<a class="thumbnail" href="" style="text-align: center">
					<span id="sparkline5">&nbsp;</span>

					<div class="caption">
						<h4> P5: 
							Estás satisfecho con los servicios de agua potable y alcantarillado en el área urbana de Cochabamba?
						</h4>
					</div>
			    </a>

              </li>            
          </ul>
</div>

