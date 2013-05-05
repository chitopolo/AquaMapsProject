<div class="dataSets index">
	<h2><?php echo __('Data Sets'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('challenge_id'); ?></th>
			<th><?php echo $this->Paginator->sort('data_set_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($dataSets as $dataSet): ?>
	<tr>
		<td><?php echo h($dataSet['DataSet']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($dataSet['ParentDataSet']['name'], array('controller' => 'data_sets', 'action' => 'view', $dataSet['ParentDataSet']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($dataSet['Challenge']['title'], array('controller' => 'challenges', 'action' => 'view', $dataSet['Challenge']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($dataSet['DataSetType']['name'], array('controller' => 'data_set_types', 'action' => 'view', $dataSet['DataSetType']['id'])); ?>
		</td>
		<td><?php echo h($dataSet['DataSet']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $dataSet['DataSet']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $dataSet['DataSet']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dataSet['DataSet']['id']), null, __('Are you sure you want to delete # %s?', $dataSet['DataSet']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Data Set'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Data Sets'), array('controller' => 'data_sets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Data Set'), array('controller' => 'data_sets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Challenges'), array('controller' => 'challenges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Challenge'), array('controller' => 'challenges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Set Types'), array('controller' => 'data_set_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Set Type'), array('controller' => 'data_set_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
