<div class="navbar navbar-fixed-top" id="top_nav">
	<div class="navbar-inner" style="padding-left:15px;">
		<?php echo $this->Html->link(__('AquaMaps'), '/', array('class' => 'brand')); ?>
		<ul class="nav" id="main_nav">
			<li>
				<?php echo $this->Html->link(__('Water in you country'), '/#pais', array('class' => 'hash')); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('Search the map'), '/#el_mapa' ,array('class' => 'hash')); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('How can you help?'), '/#ayudar', array('class' => 'hash')); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('Global data'), '/#mundo', array('class' => 'hash')); ?>
			</li>
			<li>
				<?php echo $this->Html->link(__('Mobile application'), '/Pages/mobile' ); ?>
			</li>

		</ul>
	</div>
</div>