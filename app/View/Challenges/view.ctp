<div class="challenges view">
<h2><?php  echo __('Challenge'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($challenge['Challenge']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($challenge['City']['name'], array('controller' => 'cities', 'action' => 'view', $challenge['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($challenge['Country']['name'], array('controller' => 'countries', 'action' => 'view', $challenge['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Region'); ?></dt>
		<dd>
			<?php echo $this->Html->link($challenge['Region']['name'], array('controller' => 'regions', 'action' => 'view', $challenge['Region']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($challenge['User']['id'], array('controller' => 'users', 'action' => 'view', $challenge['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($challenge['Challenge']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invitation'); ?></dt>
		<dd>
			<?php echo h($challenge['Challenge']['invitation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($challenge['Challenge']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($challenge['Challenge']['image']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Challenge'), array('action' => 'edit', $challenge['Challenge']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Challenge'), array('action' => 'delete', $challenge['Challenge']['id']), null, __('Are you sure you want to delete # %s?', $challenge['Challenge']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Challenges'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Challenge'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Surveys'); ?></h3>
	<?php if (!empty($challenge['Survey'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Challenge Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($challenge['Survey'] as $survey): ?>
		<tr>
			<td><?php echo $survey['id']; ?></td>
			<td><?php echo $survey['challenge_id']; ?></td>
			<td><?php echo $survey['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'surveys', 'action' => 'view', $survey['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'surveys', 'action' => 'edit', $survey['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'surveys', 'action' => 'delete', $survey['id']), null, __('Are you sure you want to delete # %s?', $survey['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Survey'), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
