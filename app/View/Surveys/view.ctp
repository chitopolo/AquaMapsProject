<div class="surveys view">
<h2><?php  echo __('Survey'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Challenge'); ?></dt>
		<dd>
			<?php echo $this->Html->link($survey['Challenge']['title'], array('controller' => 'challenges', 'action' => 'view', $survey['Challenge']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Survey'), array('action' => 'edit', $survey['Survey']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Survey'), array('action' => 'delete', $survey['Survey']['id']), null, __('Are you sure you want to delete # %s?', $survey['Survey']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Surveys'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Challenges'), array('controller' => 'challenges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Challenge'), array('controller' => 'challenges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Questions'); ?></h3>
	<?php if (!empty($survey['Question'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Survey Id'); ?></th>
		<th><?php echo __('Unit Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($survey['Question'] as $question): ?>
		<tr>
			<td><?php echo $question['id']; ?></td>
			<td><?php echo $question['survey_id']; ?></td>
			<td><?php echo $question['unit_id']; ?></td>
			<td><?php echo $question['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'questions', 'action' => 'view', $question['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'questions', 'action' => 'edit', $question['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'questions', 'action' => 'delete', $question['id']), null, __('Are you sure you want to delete # %s?', $question['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
