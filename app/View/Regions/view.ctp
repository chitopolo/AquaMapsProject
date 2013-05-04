<div class="regions view">
<h2><?php  echo __('Region'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($region['Region']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($region['Region']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Region'), array('action' => 'edit', $region['Region']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Region'), array('action' => 'delete', $region['Region']['id']), null, __('Are you sure you want to delete # %s?', $region['Region']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Challenges'), array('controller' => 'challenges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Challenge'), array('controller' => 'challenges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Challenges'); ?></h3>
	<?php if (!empty($region['Challenge'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Region Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Invitation'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Image'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($region['Challenge'] as $challenge): ?>
		<tr>
			<td><?php echo $challenge['id']; ?></td>
			<td><?php echo $challenge['city_id']; ?></td>
			<td><?php echo $challenge['country_id']; ?></td>
			<td><?php echo $challenge['region_id']; ?></td>
			<td><?php echo $challenge['user_id']; ?></td>
			<td><?php echo $challenge['title']; ?></td>
			<td><?php echo $challenge['invitation']; ?></td>
			<td><?php echo $challenge['description']; ?></td>
			<td><?php echo $challenge['image']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'challenges', 'action' => 'view', $challenge['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'challenges', 'action' => 'edit', $challenge['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'challenges', 'action' => 'delete', $challenge['id']), null, __('Are you sure you want to delete # %s?', $challenge['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Challenge'), array('controller' => 'challenges', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Countries'); ?></h3>
	<?php if (!empty($region['Country'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Region Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($region['Country'] as $country): ?>
		<tr>
			<td><?php echo $country['id']; ?></td>
			<td><?php echo $country['region_id']; ?></td>
			<td><?php echo $country['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'countries', 'action' => 'view', $country['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'countries', 'action' => 'edit', $country['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'countries', 'action' => 'delete', $country['id']), null, __('Are you sure you want to delete # %s?', $country['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
