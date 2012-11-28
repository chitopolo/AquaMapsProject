<!DOCTYPE html>
<html lang="es">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo __('AquaMaps').': '.$title_for_layout; ?></title>
		<?php
			echo $this->Html->meta('icon');
	
			echo $this->Html->css('bootstrap.min');
			echo $this->Html->script(array('https://www.google.com/jsapi', 'jquery.min', 'jquery-ui.min', 'bootstrap.min'));
		?>
	</head>
	<body>
		<div class="container navbar-wrapper">
			<?php echo $this->element('top_nav'); ?>
		</div>
		
		<div id="container">
			<div id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="footer">
			</div>
		</div>
		<?php echo $this->element('sql_dump'); ?>
		
	</body>
</html>