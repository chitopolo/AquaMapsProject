<!DOCTYPE html>
<html lang="es">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo __('AquaMaps').': '.$title_for_layout; ?></title>
		<?php
			echo $this->Html->meta('icon');
	
			echo $this->Html->css(array('bootstrap.min', 'aq','map'));
		?>
	<?php echo $this->Html->script(array('https://www.google.com/jsapi', 'jquery.min', 'jquery-ui.min', 'bootstrap.min', 'underscore-min','easySlider1.7.min.js','https://maps.googleapis.com/maps/api/js?key=AIzaSyB1EjUV_8Lmq6YkAQ04jwRttfGft94bXX0&sensor=true', 'map')); ?>
	</head>
	<body>
	<div class="band band-blue">
		<header id="header" class="container">
			<a id="header_logo" href="<?php echo $this->Html->url('/'); ?>"><?php echo $this->Html->image('logo_aquamaps.png', array('width' => 276, 'height' => 53, 'alt' => __('Aquamaps'))); ?></a>

			<ul id="main_menu">
				<li<?php echo $this->params['controller'] == 'pages' && $this->params['pass'][0] == 'home' ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('Inicio'), '/'); ?></li>
				<li<?php echo $this->params['controller'] == 'challenges' ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('Retos'), '/challenges'); ?></li>
				<li<?php echo $this->params['controller'] == 'pages' && $this->params['pass'][0] == 'explore' ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('Explora datos'), '/pages/explore'); ?></li>
				<li<?php echo $this->params['controller'] == 'pages' && $this->params['pass'][0] == 'mobile' ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('Bajar la App'), '/pages/mobile'); ?></li>
				<li<?php echo $this->params['controller'] == 'users' ? ' class="active"' : ''; ?>><i class="icon-user icon-white"></i> <?php echo $this->Html->link(__('Mi Cuenta'), '/users/hello'); ?></li>
			</ul>
		</header>
	</div>
	<div class="band band-content">
		<div id="content" class="container">
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<div class="band band-lblue">
		<div id="footer" class="container">
			<div class="row">
				<div class="span4">
					<h4><?php echo __('Cómo puedes ayudar?'); ?></h4>
					<ul>
						<li><?php echo $this->Html->link(__('Participa en un reto'), '/challenges'); ?></li>
							<li><?php echo $this->Html->link(__('Inicia un reto'), '/challenges'); ?></li>
						<li><?php echo $this->Html->link(__('Sube puntos de agua'), '/challenges'); ?></li>
					</ul>
				</div>
				<div class="span4">
					<h4><?php echo __('Recursos'); ?></h4>
					<ul>
						<li><?php echo $this->Html->link(__('Bajar la App'), '/pages/mobile'); ?></li>
							<li><?php echo $this->Html->link(__('Fuentes de datos'), '/pages/data_sources'); ?></li>
						<li><?php echo $this->Html->link(__('Nuesta API'), '/pages/api'); ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="band band-blue">
		<div id="bottom" class="container">
			<a id="bottom_logo" href="<?php echo $this->Html->url('/'); ?>"><?php echo $this->Html->image('logo_aquamaps.png', array('width' => 147, 'height' => 28, 'alt' => __('Aquamaps'))); ?></a>
		</div>
	</div>



	<script>
	$(document).ready(function() {		
		convertFlashMessage($("#flashMessage"));		
		convertFlashMessage($("#authMessage"), "alert-error");

		function convertFlashMessage(messageBox, alertClass) {
			if (typeof alertClass == "undefined") {
				alertClass = "alert-info";
			}
			messageBox
				.addClass("alert")
				.addClass(alertClass)
				.append('<button type="button" class="close" data-dismiss="alert">&times;</button>')
			;
		}
	});
	</script>
	<?php echo $this->Js->writeBuffer(); ?>
	<?php echo $this->element('sql_dump'); ?>
	</body>
</html>