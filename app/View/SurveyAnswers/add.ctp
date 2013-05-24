<div class="surveyAnswers form">
<?php echo $this->Form->create('SurveyAnswer'); ?>
	<fieldset>
		<legend><?php echo __('Add Survey Answer'); ?></legend>
	<?php
		echo $this->Form->input('survey_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('point_id');
		echo $this->Form->input('image');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Survey Answers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Surveys'), array('controller' => 'surveys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey'), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Points'), array('controller' => 'points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Point'), array('controller' => 'points', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Answers'), array('controller' => 'question_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Answer'), array('controller' => 'question_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
