<div class="dataSetTypes form">
<?php echo $this->Form->create('DataSetType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Data Set Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DataSetType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DataSetType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Data Set Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Data Sets'), array('controller' => 'data_sets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Set'), array('controller' => 'data_sets', 'action' => 'add')); ?> </li>
	</ul>
</div>
