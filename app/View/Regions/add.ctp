<div class="regions form">
<?php echo $this->Form->create('Region'); ?>
	<fieldset>
		<legend><?php echo __('Add Region'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Regions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Challenges'), array('controller' => 'challenges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Challenge'), array('controller' => 'challenges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
	</ul>
</div>
