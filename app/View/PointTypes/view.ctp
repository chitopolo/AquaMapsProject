<div class="pointTypes view">
<h2><?php  echo __('Point Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pointType['PointType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Id'); ?></dt>
		<dd>
			<?php echo h($pointType['PointType']['parent_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($pointType['PointType']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($pointType['PointType']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($pointType['PointType']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Point Type'), array('action' => 'edit', $pointType['PointType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Point Type'), array('action' => 'delete', $pointType['PointType']['id']), null, __('Are you sure you want to delete # %s?', $pointType['PointType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Point Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Point Type'), array('action' => 'add')); ?> </li>
	</ul>
</div>
