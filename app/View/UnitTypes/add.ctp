<div class="unitTypes form">
<?php echo $this->Form->create('UnitType'); ?>
	<fieldset>
		<legend><?php echo __('Add Unit Type'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Unit Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
