<div class="dataSets view">
<h2><?php  echo __('Data Set'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dataSet['DataSet']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Data Set'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dataSet['ParentDataSet']['name'], array('controller' => 'data_sets', 'action' => 'view', $dataSet['ParentDataSet']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Challenge'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dataSet['Challenge']['title'], array('controller' => 'challenges', 'action' => 'view', $dataSet['Challenge']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data Set Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dataSet['DataSetType']['name'], array('controller' => 'data_set_types', 'action' => 'view', $dataSet['DataSetType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($dataSet['DataSet']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Data Set'), array('action' => 'edit', $dataSet['DataSet']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Data Set'), array('action' => 'delete', $dataSet['DataSet']['id']), null, __('Are you sure you want to delete # %s?', $dataSet['DataSet']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Sets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Set'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Sets'), array('controller' => 'data_sets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Data Set'), array('controller' => 'data_sets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Challenges'), array('controller' => 'challenges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Challenge'), array('controller' => 'challenges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data Set Types'), array('controller' => 'data_set_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data Set Type'), array('controller' => 'data_set_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Data Sets'); ?></h3>
	<?php if (!empty($dataSet['ChildDataSet'])): ?>
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
		foreach ($dataSet['ChildDataSet'] as $childDataSet): ?>
		<tr>
			<td><?php echo $childDataSet['id']; ?></td>
			<td><?php echo $childDataSet['parent_id']; ?></td>
			<td><?php echo $childDataSet['challenge_id']; ?></td>
			<td><?php echo $childDataSet['data_set_type_id']; ?></td>
			<td><?php echo $childDataSet['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'data_sets', 'action' => 'view', $childDataSet['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'data_sets', 'action' => 'edit', $childDataSet['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'data_sets', 'action' => 'delete', $childDataSet['id']), null, __('Are you sure you want to delete # %s?', $childDataSet['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Data Set'), array('controller' => 'data_sets', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
