 <?php   echo $this->Html->image('brand.jpg', array('class' => 'media-object', 'min-width' => '100%'));  ?>


<div class="navbar navbar-fixed-top" id="top_nav">
	<div class="navbar-inner" style="padding-left:15px;">
		<?php echo $this->Html->link(__('AquaMaps'), '/', array('class' => 'brand')); ?>
		<ul class="nav">
		<li><a href="#pais">El agua en tu País</a></li>
			<li><a href="#ayudar">Cómo puedes ayudar?</a></li>
			<li><a href="#mundo">Datos globales</a></li>
		</ul>
	</div>
</div>