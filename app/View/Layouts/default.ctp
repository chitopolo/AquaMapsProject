<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->script(array('https://www.google.com/jsapi', 'jquery.min', 'jquery-ui.min', 'bootstrap.min'));
	?>
</head>
<body>



<div class="container navbar-wrapper" >
<div class="navbar" >
  <div class="navbar-inner" style="min-height:100px; padding-top:40px;">
    <a class="brand" href="#">AquaMaps</a>
    <ul class="nav">
      <li class="active"><a href="#">Home</a></li>
      <li><?php echo $this->Html->link(__('Pre-Universitario'), array('controller' => 'Pages', 'action' => 'home')); ?></li>
      <li><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
    </ul>
  </div>
</div>
</div>



	<div id="container">
		<div id="header">
		<!--
	<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
	
-->	

</div>
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
