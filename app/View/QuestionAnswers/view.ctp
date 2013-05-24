<div class="questionAnswers view">
<h2><?php  echo __('Question Answer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($questionAnswer['QuestionAnswer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionAnswer['Question']['name'], array('controller' => 'questions', 'action' => 'view', $questionAnswer['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Survey Answer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionAnswer['SurveyAnswer']['id'], array('controller' => 'survey_answers', 'action' => 'view', $questionAnswer['SurveyAnswer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($questionAnswer['QuestionAnswer']['value']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Question Answer'), array('action' => 'edit', $questionAnswer['QuestionAnswer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Question Answer'), array('action' => 'delete', $questionAnswer['QuestionAnswer']['id']), null, __('Are you sure you want to delete # %s?', $questionAnswer['QuestionAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Answers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Answer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Survey Answers'), array('controller' => 'survey_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey Answer'), array('controller' => 'survey_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
