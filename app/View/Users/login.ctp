<div class="row">
	<div class="span5 offset1">
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
		<fieldset>
			<legend>Loggeate</legend>
			<?php
			echo $this->Form->input('email', array('label' => __('Email'), 'class' => 'input-large'));
			echo $this->Form->input('password', array('label' => __('Contraseña'), 'class' => 'input-large'));
			?>
		</fieldset>
	<?php
	$registerButton = ' ' . $this->Html->tag('span', __('o') . ' ' . $this->Html->link(__('Crear una cuenta'), '/users/register'), array('class' => 'lead muted'));
	
	echo $this->Form->submit(__('Entrar'), array('class' => 'btn btn-primary btn-large', 'after' => $registerButton));
	echo $this->Form->end();
	?>
	
	<hr />
	
	<p>O conéctate con: <strong><?php echo $this->Html->link(__('Facebook'), array('controller' => 'users', 'action' => 'loginFacebook'), array('class' => 'btn')); ?></strong> o <strong><?php echo $this->Html->link(__('Google'), array('controller' => 'users', 'action' => 'loginGoogle'), array('class' => 'btn')); ?></strong></p>
	
	</div>

	<div class="span5">
		<h2><?php echo __('Una cuenta en Aquamaps'); ?></h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia error provident voluptate unde quae cumque expedita atque fuga sit veritatis ex fugiat iure dolore quibusdam accusantium illum nesciunt eos tenetur.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia error provident voluptate unde quae cumque expedita atque fuga sit veritatis ex fugiat iure dolore quibusdam accusantium illum nesciunt eos tenetur.</p>
	</div>
</div>
