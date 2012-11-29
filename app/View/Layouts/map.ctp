<!DOCTYPE html>
<html id="map">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->meta('icon');	
			echo $this->Html->css(array('bootstrap.min', 'map'));
			echo $this->Html->script(array('jquery.min', 'jquery-ui.min', 'bootstrap.min', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB1EjUV_8Lmq6YkAQ04jwRttfGft94bXX0&sensor=true', 'http://www.google.com/jsapi', 'map'));		
		?>
	</head>
	<body>
		<div class="container-fluid" id="main">
			<?php echo $this->element('top_nav'); ?>
			<div class="row-fluid" id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</body>
</html>
