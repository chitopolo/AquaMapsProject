<h1>Hola, <?php echo $current['User']['first_name'].' '.$current['User']['last_name']; ?>!</h1>

<ul class="lead">
	<li><?php echo $this->Html->link(__('Edita tu cuenta'), '/users/edit'); ?></li>
</ul>
