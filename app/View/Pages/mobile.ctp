<div class="row-fluid" >
	<div class="span4">
		<h2 style="opacity: 0.5;">Pronto disponible en</h2>
		<ul class="heading-icons">
		<li class=""><a  target="_blank">
		<?php   echo $this->Html->image('android-small-logo.png') ?> 
		</a></li>
		<li class=""><a  target="_blank">
		<?php   echo $this->Html->image('iphone-small-logo.png', array('width'=>100)) ?>
		</a>
		</li>
		</ul>
	</div>
	<div id="phonescreens" class="span4" >
		<div id="slider">
			<ul>				
				<li><?php   echo $this->Html->image('image_1.png') ?> </li>
				<li><?php   echo $this->Html->image('image_2.png') ?> </li>
				<li><?php   echo $this->Html->image('image_3.png') ?> </li>
				<li><?php   echo $this->Html->image('image_4.png') ?> </li>
				<li><?php   echo $this->Html->image('image_6.png') ?> </li>
				<li><?php   echo $this->Html->image('image_7.png') ?> </li>
			</ul>
		</div>
	</div>
	<div id="features" class="span4">
		<h1 style="opacity: 0.6">Caracteristicas</h1>
		<ul class="featurelist" style="font-size: 24px;">

			<li class="BulletImage" style="opacity: 0.8">Recopila datos de saneamiento y agua. </li>
			<li class="BulletImage" style="opacity: 0.8">Compartelo con tu organizacion y el mundo.</li>
			<li class="BulletImage" style="opacity: 0.8">Visualiza tus datos</li>
			<li class="BulletImage" style="opacity: 0.8">Enriquecido con Data Sets del Banco Mundial</li>
		</ul>
	</div>
</div>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true,
				pause: 5000,
				controlsShow: false
			});
		});	
	</script>




