<div class="questionAnswers form">
<?php echo $this->Form->create('QuestionAnswer'); ?>
	<fieldset>
		<legend><?php echo __('Add Question Answer'); ?></legend>
	<?php
		echo $this->Form->input('question_id');
		echo $this->Form->input('survey_answer_id');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Question Answers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Survey Answers'), array('controller' => 'survey_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey Answer'), array('controller' => 'survey_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
