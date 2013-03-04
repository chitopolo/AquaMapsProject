<!DOCTYPE html>
<html lang="es">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo __('AquaMaps').': '.$title_for_layout; ?></title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css(array('bootstrap.min', 'aq','map'));
			echo $this->Html->script(array('https://www.google.com/jsapi', 'jquery.min', 'jquery-ui.min', 'easySlider1.7.min.js', 'bootstrap.min', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB1EjUV_8Lmq6YkAQ04jwRttfGft94bXX0&sensor=true', 'map'));
		?>
	</head>
	<body>
		<div class="container-fluid navbar-wrapper">
			<?php echo $this->element('top_image'); ?>
			<?php echo $this->element('top_nav'); ?>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<div id="footer">
			</div>
		</div>
		<?php echo $this->element('sql_dump'); ?>
		
	</body>
</html>