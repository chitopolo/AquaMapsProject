<div class="pointTypes index">
	<h2><?php echo __('Point Types'); ?></h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lft'); ?></th>
			<th><?php echo $this->Paginator->sort('rght'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($pointTypes as $pointType): ?>
	<tr>
		<td><?php echo h($pointType['PointType']['id']); ?>&nbsp;</td>
		<td><?php echo h($pointType['PointType']['parent_id']); ?>&nbsp;</td>
		<td><?php echo h($pointType['PointType']['lft']); ?>&nbsp;</td>
		<td><?php echo h($pointType['PointType']['rght']); ?>&nbsp;</td>
		<td><?php echo h($pointType['PointType']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $pointType['PointType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $pointType['PointType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $pointType['PointType']['id']), null, __('Are you sure you want to delete # %s?', $pointType['PointType']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Point Type'), array('action' => 'add')); ?></li>
	</ul>
</div>
