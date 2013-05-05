<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Nuevo reto'), array('action' => 'add')); ?></li>
	</ul>
</div>
<div class="challenges index">
	<div class="row-fluid">
		<ul class="thumbnails">
	<?php
	foreach ($challenges as $challenge): ?>
		<li class="span4">
		    <div class="thumbnail">
		      <img data-src="holder.js/300x200" alt="300x200" style="width: 300px; height: 200px;" src="">
		      <div class="caption">
		        <h3><?php echo h($challenge['Challenge']['title']); ?></h3>
		        <p><?php echo h($challenge['Challenge']['invitation']); ?></p>

				<?php echo h($challenge['City']['name'] + ", " + $challenge['Country']['name']); ?>

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
