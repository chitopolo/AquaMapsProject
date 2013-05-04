<div class="questionOptions view">
<h2><?php  echo __('Question Option'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($questionOption['QuestionOption']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionOption['Question']['name'], array('controller' => 'questions', 'action' => 'view', $questionOption['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($questionOption['QuestionOption']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($questionOption['QuestionOption']['value']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Question Option'), array('action' => 'edit', $questionOption['QuestionOption']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Question Option'), array('action' => 'delete', $questionOption['QuestionOption']['id']), null, __('Are you sure you want to delete # %s?', $questionOption['QuestionOption']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Options'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Option'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
