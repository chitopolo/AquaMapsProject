<h1><?php echo h($challenge['Challenge']['title']); ?></h1>
<div class="row">
	<?php if (!empty($challenge['Challenge']['image'])): ?>
		<?php $descriptionSpan = 4; ?>
		<?php $invitationContent = ''; ?>
		<div class="span8">
			<div class="challenge-image">
				<img src="<?php echo $this->Html->url('/img/challenges/' . $challenge['Challenge']['image']); ?>" alt="<?php echo $challenge['Challenge']['title']; ?>">
				<h3><?php echo h($challenge['Challenge']['invitation']); ?></h3>
			</div>
		</div>
	<?php else: ?>
		<?php $descriptionSpan = 12; ?>
		<?php $invitationContent = $this->Html->tag('h3', $challenge['Challenge']['invitation']); ?>
	<?php endif; ?>
	<div class="span<?php echo $descriptionSpan; ?>">
		<?php echo $invitationContent; ?>
		<?php echo h($challenge['Challenge']['description']); ?>
		<hr />
		<div class="row">
			<div class="span<?php echo $descriptionSpan/3; ?>">
				<h4><?php echo __('Alcance'); ?></h4>
				<?php
				$scope = '';
				$scope .= !empty($challenge['City']['name']) ? $challenge['City']['name'] . ', ' : '';
				$scope .= !empty($challenge['Region']['name']) ? ', ' . $challenge['Region']['name'] . ', ' : '';
				$scope .= $challenge['Country']['name'];
				?>
				<p class="lead"><?php echo $scope; ?></p>
			</div>
			<div class="span<?php echo $descriptionSpan/3; ?>">
				<h4><?php echo __('Likes'); ?></h4>
				
			</div>
			<div class="span<?php echo $descriptionSpan/3; ?>">
				
			</div>
		</div>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Surveys'); ?></h3>
	<?php if (!empty($challenge['Survey'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Challenge Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($challenge['Survey'] as $survey): ?>
		<tr>
			<td><?php echo $survey['id']; ?></td>
			<td><?php echo $survey['challenge_id']; ?></td>
			<td><?php echo $survey['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'surveys', 'action' => 'view', $survey['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'surveys', 'action' => 'edit', $survey['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'surveys', 'action' => 'delete', $survey['id']), null, __('Are you sure you want to delete # %s?', $survey['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Survey'), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
