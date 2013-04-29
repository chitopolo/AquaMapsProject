<div class="row">
	<div class="span5 offset1">
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'edit'))); ?>
	<fieldset>
		<legend>Edita tu cuenta</legend>
		<?php
		echo $this->Form->input('first_name', array('label' => __('Nombre'), 'class' => 'input-large'));
		echo $this->Form->input('last_name', array('label' => __('Apellido'), 'class' => 'input-large'));
		echo $this->Form->input('email', array('label' => __('Email'), 'class' => 'input-large'));
		//echo '<hr />';
		//echo $this->Form->input('password_current', array('type' => 'password', 'label' => __('Contraseña actual'), 'value' => '', 'autocomplete' => 'off', 'class' => 'input-large'));
		//echo $this->Form->input('password_new', array('type' => 'password', 'label' => __('Contraseña nueva'), 'class' => 'input-large'));
		?>
	</fieldset>
	<?php
	echo $this->Form->submit(__('Guardar cambios'), array('div' => false, 'class' => 'btn btn-primary btn-large'));
	echo $this->Form->end();
	?>
	</div>
</div>