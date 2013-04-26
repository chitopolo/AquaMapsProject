<div class="pointTypes form">
<?php echo $this->Form->create('PointType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Point Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('parent_id', array('empty' => true));
		echo $this->Form->input('name');
		echo $this->Form->input('description', array('type' => 'textarea'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PointType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PointType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Point Types'), array('action' => 'index')); ?></li>
	</ul>
</div>
