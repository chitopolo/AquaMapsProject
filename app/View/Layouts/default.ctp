<!DOCTYPE html>
<html lang="es">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo __('AquaMaps').': '.$title_for_layout; ?></title>
		<?php
			echo $this->Html->meta('icon');
	
			echo $this->Html->css(array('bootstrap.min', 'aq'));
			echo $this->Html->script(array('https://www.google.com/jsapi', 'jquery.min', 'jquery-ui.min', 'bootstrap.min', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB1EjUV_8Lmq6YkAQ04jwRttfGft94bXX0&sensor=true', 'map'));
		?>
	</head>
	<body>
	<div class="band band-blue">
		<header id="header" class="container">
			<a id="header_logo" href="<?php echo $this->Html->url('/'); ?>"><?php echo $this->Html->image('logo_aquamaps.png', array('width' => 276, 'height' => 53, 'alt' => __('Aquamaps'))); ?></a>

			<ul id="main_menu">
				<li class="active"><?php echo $this->Html->link(__('Inicio'), '/'); ?></li>
				<li><?php echo $this->Html->link(__('Mapa'), '/reports'); ?></li>
				<li><?php echo $this->Html->link(__('Agua en tu país'), '/tribes'); ?></li>
				<li><?php echo $this->Html->link(__('App móvil'), '/tribes'); ?></li>
				<li><?php echo $this->Html->link(__('Mi Cuenta'), '#loginModal', array('role' => 'button', 'data-toggle' => 'modal')); ?></li>
			</ul>
		</header>
	</div>
	<div class="band band-header">
		<div class="container">
			<?php //echo $this->element('top_nav'); ?>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<div id="footer">
			</div>
		</div>
	</div>
	<div class="band band-blue">
		<div id="footer" class="container">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>		
	</body>
</html>