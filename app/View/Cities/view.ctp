<div class="cities view">
<h2><?php  echo __('City'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($city['City']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($city['Country']['name'], array('controller' => 'countries', 'action' => 'view', $city['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($city['City']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit City'), array('action' => 'edit', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete City'), array('action' => 'delete', $city['City']['id']), null, __('Are you sure you want to delete # %s?', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Challenges'), array('controller' => 'challenges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Challenge'), array('controller' => 'challenges', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Challenges'); ?></h3>
	<?php if (!empty($city['Challenge'])): ?>
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
		foreach ($city['Challenge'] as $challenge): ?>
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
