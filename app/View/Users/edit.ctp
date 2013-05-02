<div class="row">
	<div class="span5 offset1">
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'edit'))); ?>
		<fieldset>
			<legend>Edita tu cuenta</legend>
			<?php
			echo $this->Form->input('first_name', array('label' => __('Nombre'), 'class' => 'input-large'));
			echo $this->Form->input('last_name', array('label' => __('Apellido'), 'class' => 'input-large'));
			echo $this->Form->input('email', array('label' => __('Email'), 'class' => 'input-large'));
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
			<li><?php echo $this->Html->link(__('Editar contraseña'), '/users/editPassword'); ?></li>
		</ul>
	</div>
</div>