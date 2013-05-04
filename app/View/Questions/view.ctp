<div class="questions view">
<h2><?php  echo __('Question'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($question['Question']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Survey'); ?></dt>
		<dd>
			<?php echo $this->Html->link($question['Survey']['name'], array('controller' => 'surveys', 'action' => 'view', $question['Survey']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit'); ?></dt>
		<dd>
			<?php echo $this->Html->link($question['Unit']['name'], array('controller' => 'units', 'action' => 'view', $question['Unit']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($question['Question']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Question'), array('action' => 'edit', $question['Question']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Question'), array('action' => 'delete', $question['Question']['id']), null, __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Surveys'), array('controller' => 'surveys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey'), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Options'), array('controller' => 'question_options', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Option'), array('controller' => 'question_options', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Question Options'); ?></h3>
	<?php if (!empty($question['QuestionOption'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($question['QuestionOption'] as $questionOption): ?>
		<tr>
			<td><?php echo $questionOption['id']; ?></td>
			<td><?php echo $questionOption['question_id']; ?></td>
			<td><?php echo $questionOption['description']; ?></td>
			<td><?php echo $questionOption['value']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'question_options', 'action' => 'view', $questionOption['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'question_options', 'action' => 'edit', $questionOption['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'question_options', 'action' => 'delete', $questionOption['id']), null, __('Are you sure you want to delete # %s?', $questionOption['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question Option'), array('controller' => 'question_options', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
