<div class="dataSets form">
<?php echo $this->Form->create('DataSet'); ?>
	<fieldset>
		<legend><?php echo __('Add Data Set'); ?></legend>
	<?php
		echo $this->Form->input('parent_id');
		echo $this->Form->input('challenge_id');
		echo $this->Form->input('data_set_type_id');
		echo $this->Form->input('name');
		echo $this->Form->input('mappable');
		echo $this->Form->input('public');
		echo $this->Form->input('source_link');
		echo $this->Form->input('source_table');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Data Sets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Data Sets'), array('controller' => 'data_sets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Data Set'), array('controller' => 'data_sets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Challenges'), array('controller' => 'challenges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Challenge'), array('controller' => 'challenges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Set Types'), array('controller' => 'data_set_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Set Type'), array('controller' => 'data_set_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
