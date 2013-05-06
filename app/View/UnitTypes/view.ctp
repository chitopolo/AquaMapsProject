<div class="unitTypes view">
<h2><?php  echo __('Unit Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($unitType['UnitType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($unitType['UnitType']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($unitType['UnitType']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Unit Type'), array('action' => 'edit', $unitType['UnitType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Unit Type'), array('action' => 'delete', $unitType['UnitType']['id']), null, __('Are you sure you want to delete # %s?', $unitType['UnitType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Unit Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Units'); ?></h3>
	<?php if (!empty($unitType['Unit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Unit Type Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unitType['Unit'] as $unit): ?>
		<tr>
			<td><?php echo $unit['id']; ?></td>
			<td><?php echo $unit['unit_type_id']; ?></td>
			<td><?php echo $unit['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'units', 'action' => 'view', $unit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'units', 'action' => 'edit', $unit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'units', 'action' => 'delete', $unit['id']), null, __('Are you sure you want to delete # %s?', $unit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
