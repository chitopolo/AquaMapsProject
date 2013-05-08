<?php echo $this->Html->link(__('Nuevo reto'), array('action' => 'add'), array('class' => 'btn btn-large btn-primary pull-right')); ?>
<h1 class="cleasrfix mb"><?php echo __('Retos'); ?></h1>
<div class="challenges index">
	<div class="row-fluid">
		<ul class="thumbnails challenges">
	<?php foreach ($challenges as $challenge): ?>
		<li class="span4">
		    <a class="thumbnail" href="<?php echo $this->Html->url('/challenges/view/' . $challenge['Challenge']['id']); ?>">
				<div class="thumbnail-image">
					<?php
					if (!empty($challenge['Challenge']['image'])) {
						$imageFile = $this->Html->url('/img/challenges/' . $challenge['Challenge']['image']);
					} else {
						$imageFile = $this->Html->url('/img/placeholders/ch_ph_' . rand(1, 2) . '.jpg');
					}
					?>
					<img src="<?php echo $imageFile; ?>" alt="<?php echo $challenge['Challenge']['title']; ?>">
				</div>
				<div class="caption">
					<h4><?php echo $challenge['Challenge']['title']; ?></h4>
					<!--<h3><?php echo $this->Html->link($challenge['Challenge']['title'], array('action' => 'view', $challenge['Challenge']['id'])); ?></h3>-->
					<!--<p><?php echo h($challenge['Challenge']['invitation']); ?></p>-->	
					<!--<p><small><?php echo h($challenge['City']['name'] + ", " + $challenge['Country']['name']); ?></small></p>-->	
				</div>
		    </a>
		 </li>
	<?php endforeach; ?>
	</ul>
	</div>
	<p>
	<?php
	//echo $this->Paginator->counter(array(
	//'format' => __('Pagina {:page} de {:pages}, mostrando {:current} retos de un total de {:count} , empezando en  {:start}, terminando en {:end}')
	//));
	?>
	</p>

	<div class="paging">
	<?php
		//echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		//echo $this->Paginator->numbers(array('separator' => ''));
		//echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
