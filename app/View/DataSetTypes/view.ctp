<div class="dataSetTypes view">
<h2><?php  echo __('Data Set Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dataSetType['DataSetType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($dataSetType['DataSetType']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Data Set Type'), array('action' => 'edit', $dataSetType['DataSetType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Data Set Type'), array('action' => 'delete', $dataSetType['DataSetType']['id']), null, __('Are you sure you want to delete # %s?', $dataSetType['DataSetType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Set Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Set Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Sets'), array('controller' => 'data_sets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Set'), array('controller' => 'data_sets', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Data Sets'); ?></h3>
	<?php if (!empty($dataSetType['DataSet'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Challenge Id'); ?></th>
		<th><?php echo __('Data Set Type Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($dataSetType['DataSet'] as $dataSet): ?>
		<tr>
			<td><?php echo $dataSet['id']; ?></td>
			<td><?php echo $dataSet['parent_id']; ?></td>
			<td><?php echo $dataSet['challenge_id']; ?></td>
			<td><?php echo $dataSet['data_set_type_id']; ?></td>
			<td><?php echo $dataSet['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'data_sets', 'action' => 'view', $dataSet['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'data_sets', 'action' => 'edit', $dataSet['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'data_sets', 'action' => 'delete', $dataSet['id']), null, __('Are you sure you want to delete # %s?', $dataSet['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Data Set'), array('controller' => 'data_sets', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
