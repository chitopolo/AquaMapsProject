 <?php   echo $this->Html->image('brand.jpg', array('class' => 'media-object', 'min-width' => '100%'));  ?>


<div class="navbar navbar-fixed-top" id="top_nav">
	<div class="navbar-inner" style="padding-left:15px;">
		<?php echo $this->Html->link(__('AquaMaps'), '/', array('class' => 'brand')); ?>
		<ul class="nav" id="main_nav">
			<li><a href="#pais">El agua en tu país</a></li>
			<li><a href="#el_mapa">Busca en el mapa</a></li>
			<li><a href="#ayudar">Cómo puedes ayudar?</a></li>
			<li><a href="#mundo">Datos globales</a></li>
		</ul>
	</div>
</div>