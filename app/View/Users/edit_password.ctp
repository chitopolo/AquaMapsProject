<div class="row">
	<div class="span5 offset1">
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'editPassword'))); ?>
	<fieldset>
		<legend>Edita tu contraseña</legend>
		<?php
		echo $this->Form->input('password_current', array('type' => 'password', 'label' => __('Contraseña actual'), 'value' => '', 'autocomplete' => 'off', 'class' => 'input-large'));
		echo $this->Form->input('password_new', array('type' => 'password', 'label' => __('Contraseña nueva'), 'class' => 'input-large'));
		?>
	</fieldset>
	<?php
	echo $this->Form->submit(__('Guardar cambios'), array('div' => false, 'class' => 'btn btn-primary btn-large'));
	echo $this->Form->end();
	?>
	</div>
	<div class="span4">
		<ul>
			<li><?php echo $this->Html->link(__('Inicio'), '/users/hello'); ?></li>
			<li><?php echo $this->Html->link(__('Editar cuenta'), '/users/edit'); ?></li>
		</ul>
	</div>
</div>