<div class="row-fluid" >
	<div class="span4">
		<h3 class="muted">Pronto disponible:</h3>
		<ul class="heading-icons">
			<li class=""><a href="#" target="_blank">
				<?php echo $this->Html->image('android-small-logo.png') ?> 
			</a></li>
			<li class=""><a href="#" target="_blank">
				<?php echo $this->Html->image('iphone-small-logo.png', array('width'=>100)) ?>
			</a>
			</li>
		</ul>
		<br class="clearfix mb">
		<?php if (!$this->Session->check('userEmail')): ?>
		<?php echo $this->Form->create('User', array('id' => 'add_question_form', 'class' => 'box-mod mt', 'url' => array('controller' => 'users', 'action' => 'preRegister'))); ?>
			<p class="text-center"><?php echo __('Quieres que te avisemos cuando esté disponible?'); ?></p>
		<?php
			echo $this->Form->input('email', array('label' => false, 'placeholder' => __('Escribe tu email'), 'div' => 'input', 'type' => 'email', 'class' => 'input-xlarge'));
			
			echo $this->Form->submit(__('Pre-inscribirme!'), array('class' => 'btn btn-success btn-large', 'div' => 'text-right'));
		?>
		<?php echo $this->Form->end(); ?>
		<?php else: ?>
			<hr class="mt mb">
			<p class="mt"><?php echo __('Ya registramos tu email para notificarte') . ': ' . $this->Session->read('userEmail'); ?></p>
		<?php endif; ?>
	</div>
	<div id="phonescreens" class="span4">
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
		<ul class="list-feature mt">
			<li>Recopila datos de saneamiento y agua. </li>
			<li>Compártelo con tu organización y el mundo.</li>
			<li>Visualiza tus datos.</li>
			<li>Enriquecido con datos del Banco Mundial.</li>
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




