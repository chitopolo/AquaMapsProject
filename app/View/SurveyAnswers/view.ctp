<div class="surveyAnswers view">
<h2><?php  echo __('Survey Answer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($surveyAnswer['SurveyAnswer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Survey'); ?></dt>
		<dd>
			<?php echo $this->Html->link($surveyAnswer['Survey']['name'], array('controller' => 'surveys', 'action' => 'view', $surveyAnswer['Survey']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($surveyAnswer['User']['id'], array('controller' => 'users', 'action' => 'view', $surveyAnswer['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Point'); ?></dt>
		<dd>
			<?php echo $this->Html->link($surveyAnswer['Point']['id'], array('controller' => 'points', 'action' => 'view', $surveyAnswer['Point']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($surveyAnswer['SurveyAnswer']['image']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Survey Answer'), array('action' => 'edit', $surveyAnswer['SurveyAnswer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Survey Answer'), array('action' => 'delete', $surveyAnswer['SurveyAnswer']['id']), null, __('Are you sure you want to delete # %s?', $surveyAnswer['SurveyAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Survey Answers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey Answer'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Question Answers'); ?></h3>
	<?php if (!empty($surveyAnswer['QuestionAnswer'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Survey Answer Id'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($surveyAnswer['QuestionAnswer'] as $questionAnswer): ?>
		<tr>
			<td><?php echo $questionAnswer['id']; ?></td>
			<td><?php echo $questionAnswer['question_id']; ?></td>
			<td><?php echo $questionAnswer['survey_answer_id']; ?></td>
			<td><?php echo $questionAnswer['value']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'question_answers', 'action' => 'view', $questionAnswer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'question_answers', 'action' => 'edit', $questionAnswer['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'question_answers', 'action' => 'delete', $questionAnswer['id']), null, __('Are you sure you want to delete # %s?', $questionAnswer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question Answer'), array('controller' => 'question_answers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
