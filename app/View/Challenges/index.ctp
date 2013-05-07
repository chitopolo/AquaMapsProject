<?php echo $this->Html->link(__('Nuevo reto'), array('action' => 'add'), array('class' => 'btn btn-large btn-primary pull-right')); ?>
<h1 class="cleasrfix mb"><?php echo __('Retos'); ?></h1>
<div class="challenges index">
	<div class="row-fluid">
		<ul class="thumbnails">
	<?php
	foreach ($challenges as $challenge): ?>
		<li class="span4">
		    <div class="thumbnail">
				<?php if (!empty($challenge['Challenge']['image'])): ?>
					<img src="<?php echo $this->Html->url('/img/challenges/' . $challenge['Challenge']['image']); ?>" alt="300x200" style="max-width: 300px; max-height: 200px;">
				<?php else: ?>
				<div style="width: 300px; height: 200px; background-color: #CCC;"></div>
					<!--<img data-src="<?php echo $this->Html->url('challenges/' . $challenge['Challenge']['image']); ?>" alt="300x200" style="width: 300px; height: 200px;" src="">-->
				<?php endif; ?>
		      <div class="caption">
		        <h3><?php echo $this->Html->link($challenge['Challenge']['title'], array('action' => 'view', $challenge['Challenge']['id'])); ?></h3>
		        <p><?php echo h($challenge['Challenge']['invitation']); ?></p>

				<!--<p><small><?php echo h($challenge['City']['name'] + ", " + $challenge['Country']['name']); ?></small></p>-->

		      </div>
		    </div>
		 </li>


<?php endforeach; ?>
	</ul>
	</div>


	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagina {:page} de {:pages}, mostrando {:current} retos de un total de {:count} , empezando en  {:start}, terminando en {:end}')
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
