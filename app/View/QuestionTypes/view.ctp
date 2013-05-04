<div class="questionTypes view">
<h2><?php  echo __('Question Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($questionType['QuestionType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($questionType['QuestionType']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Question Type'), array('action' => 'edit', $questionType['QuestionType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Question Type'), array('action' => 'delete', $questionType['QuestionType']['id']), null, __('Are you sure you want to delete # %s?', $questionType['QuestionType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Type'), array('action' => 'add')); ?> </li>
	</ul>
</div>
