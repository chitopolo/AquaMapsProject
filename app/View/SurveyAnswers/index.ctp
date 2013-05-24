<div class="surveyAnswers index">
	<h2><?php echo __('Survey Answers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('survey_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('point_id'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($surveyAnswers as $surveyAnswer): ?>
	<tr>
		<td><?php echo h($surveyAnswer['SurveyAnswer']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($surveyAnswer['Survey']['name'], array('controller' => 'surveys', 'action' => 'view', $surveyAnswer['Survey']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($surveyAnswer['User']['id'], array('controller' => 'users', 'action' => 'view', $surveyAnswer['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($surveyAnswer['Point']['id'], array('controller' => 'points', 'action' => 'view', $surveyAnswer['Point']['id'])); ?>
		</td>
		<td><?php echo h($surveyAnswer['SurveyAnswer']['image']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $surveyAnswer['SurveyAnswer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $surveyAnswer['SurveyAnswer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $surveyAnswer['SurveyAnswer']['id']), null, __('Are you sure you want to delete # %s?', $surveyAnswer['SurveyAnswer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Survey Answer'), array('action' => 'add')); ?></li>
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
