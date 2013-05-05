<div class="challenges index">
	<h2><?php echo __('Challenges'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('city_id'); ?></th>
			<th><?php echo $this->Paginator->sort('country_id'); ?></th>
			<th><?php echo $this->Paginator->sort('region_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('invitation'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($challenges as $challenge): ?>
	<tr>
		<td><?php echo h($challenge['Challenge']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($challenge['City']['name'], array('controller' => 'cities', 'action' => 'view', $challenge['City']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($challenge['Country']['name'], array('controller' => 'countries', 'action' => 'view', $challenge['Country']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($challenge['Region']['name'], array('controller' => 'regions', 'action' => 'view', $challenge['Region']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($challenge['User']['id'], array('controller' => 'users', 'action' => 'view', $challenge['User']['id'])); ?>
		</td>
		<td><?php echo h($challenge['Challenge']['title']); ?>&nbsp;</td>
		<td><?php echo h($challenge['Challenge']['invitation']); ?>&nbsp;</td>
		<td><?php echo h($challenge['Challenge']['description']); ?>&nbsp;</td>
		<td><?php echo h($challenge['Challenge']['image']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $challenge['Challenge']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $challenge['Challenge']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $challenge['Challenge']['id']), null, __('Are you sure you want to delete # %s?', $challenge['Challenge']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Challenge'), array('action' => 'add')); ?></li>
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
