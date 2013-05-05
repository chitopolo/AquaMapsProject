<div class="challenges form">
<?php echo $this->Form->create('Challenge'); ?>
	<fieldset>
		<legend><?php echo __('Reto'); ?></legend>
	<?php
		echo $this->Form->input('city_id');
		echo $this->Form->input('country_id');
		echo $this->Form->input('region_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('title');
		echo $this->Form->input('invitation');
		echo $this->Form->input('description');
		echo $this->Form->input('image');
	?>
	<legend><?php echo __('Datos'); ?></legend>
	<?php
		echo $this->Form->input('Survey.0.name', array('label' => 'Nombre cuestionario:'));
		echo $this->Form->input('Survey.0.Question.0.name', array('label' => 'Pregunta:'));
		echo $this->Form->input('Survey.0.Question.0.unit_id', array('label' => 'Unidad:'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Challenges'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Surveys'), array('controller' => 'surveys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey'), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
	</ul>
</div>
