<div class="institutions view">
<h2><?php  echo __('Institution'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($institution['Institution']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Institution'), array('action' => 'edit', $institution['Institution']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Institution'), array('action' => 'delete', $institution['Institution']['id']), null, __('Are you sure you want to delete # %s?', $institution['Institution']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Institutions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institution'), array('action' => 'add')); ?> </li>
	</ul>
</div>
