<div class="dataSets form">
<?php echo $this->Form->create('DataSet'); ?>
	<fieldset>
		<legend><?php echo __('Edit Data Set'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('challenge_id');
		echo $this->Form->input('data_set_type_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DataSet.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DataSet.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Data Sets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Data Sets'), array('controller' => 'data_sets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Data Set'), array('controller' => 'data_sets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Challenges'), array('controller' => 'challenges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Challenge'), array('controller' => 'challenges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Set Types'), array('controller' => 'data_set_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Set Type'), array('controller' => 'data_set_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
