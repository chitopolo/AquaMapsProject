<div class="questionAnswers index">
	<h2><?php echo __('Question Answers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('question_id'); ?></th>
			<th><?php echo $this->Paginator->sort('survey_answer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($questionAnswers as $questionAnswer): ?>
	<tr>
		<td><?php echo h($questionAnswer['QuestionAnswer']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($questionAnswer['Question']['name'], array('controller' => 'questions', 'action' => 'view', $questionAnswer['Question']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($questionAnswer['SurveyAnswer']['id'], array('controller' => 'survey_answers', 'action' => 'view', $questionAnswer['SurveyAnswer']['id'])); ?>
		</td>
		<td><?php echo h($questionAnswer['QuestionAnswer']['value']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $questionAnswer['QuestionAnswer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $questionAnswer['QuestionAnswer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $questionAnswer['QuestionAnswer']['id']), null, __('Are you sure you want to delete # %s?', $questionAnswer['QuestionAnswer']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Question Answer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Survey Answers'), array('controller' => 'survey_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey Answer'), array('controller' => 'survey_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
