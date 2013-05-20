
<!-- RP: Start Blue Space -->
<div class="box-blsue home">
	<div class="row">

		<div class="span4 text-center">
			<?php // echo $this->Html->image('text-hero.png', array('width' => 350, 'alt' => __('Aquamaps'))); ?>
			<p class="lead">AquaMapas es un herramienta de <strong>colaboración abierta</strong> para la recopilación de información de <strong>saneamiento y agua potable.</strong></p>
			<br>
			<a href="<?php echo $this->Html->url('/'); ?>"><?php echo $this->Html->image('logo_aquamaps_inv.png', array('width' => 200, 'alt' => __('Aquamapas'))); ?></a>
		</div>
		
		<div class="span8">
			<div id="myCarousel" class="carousel slide">
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1" class=""></li>
					<li data-target="#myCarousel" data-slide-to="2" class=""></li>
					<li data-target="#myCarousel" data-slide-to="3" class=""></li>
				</ol>
				<div class="carousel-inner">
					<div class="item active">
						<a href="<?php echo $this->Html->url('/pages/explore'); ?>">
							<div class="carousel-img"><img src="<?php echo $this->Html->url('/img/carousel/explora.jpg'); ?>" alt="Explora los data sets disponibles de saneamiento en LatinoAmerica"></div>
							<div class="carousel-caption">
								<h4>Explora los datos</h4>
								<p>Explora los data sets disponibles de saneamiento en LatinoAmerica</p>
							</div>
						</a>
					</div>
					
					<div class="item">
						<a href="http://www.hackatonsaneamiento.la/equipo-aquamapas/" target="_blank">
							<div class="carousel-img"><img src="<?php echo $this->Html->url('/img/carousel/finalista.jpg'); ?>" alt="Aquamapas, finalista del Hackathon de Saneamiento"></div>
							<div class="carousel-caption">
								<h4>Finalista del Hackathon de Saneamiento</h4>
								<p>AquaMapas esta entre los finalistas del hackathon de Saneamiento. Apoya con tu voto para este proyecto.</p>
							</div>
						</a>
					</div>
					
					<div class="item">
						<a href="<?php echo $this->Html->url('/pages/mobile'); ?>">
							<div class="carousel-img"><img src="<?php echo $this->Html->url('/img/carousel/app.jpg'); ?>" alt="Baja la app de AquaMapas"></div>
							<div class="carousel-caption">
								<h4>Baja nuestra App</h4>
								<p>Colabora con AquaMapas a través de nuestra aplicación móvil!</p>
							</div>
						</a>
					</div>
					
					<div class="item">
						<a href="<?php echo $this->Html->url('/pages/api'); ?>">
							<div class="carousel-img"><img src="<?php echo $this->Html->url('/img/carousel/api.jpg'); ?>" alt="Aquamapas, finalista del Hackathon de Saneamiento"></div>
							<div class="carousel-caption">
								<h4>Conoce nuestra API</h4>
								<p>Utiliza nuestra API para interacturar con nuestros datos y desarrollar nuevas aplicaciones.</p>
							</div>
						</a>
					</div>
				</div>
			
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
			</div>
		</div>

	</div>
</div>

<div>
	<h3 class="clearfix mb"><?php echo __('Retos destacados'); ?></h3>

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
	</div>
</div>


<!-- RP: Ends Blue Space -->

<div class="box-blue">
	<div class="container-fluid" >
		<div class="row-fluid">
			<div class="span12">
			<h2>Cómo puedes ayudar?</h2>
			
				<ul class="thumbnails">
					
					<li class="span3 text-center">
						<a href="<?php echo $this->Html->url('/challenges/view/'); ?>">
							<?php echo $this->Html->image('dwn_help.png'); ?>
							<h3> Recolecta datos</h3>
							<p> If you are part of an organization that works with santitation and water projects. And even if your a indvidual that is traveling. You can help us by collect data with your mobile app.</p>
						</a>		
					</li>
					
					<li class="span3 text-center">
						<a href="<?php echo $this->Html->url('/challenges/view/'); ?>">
							<?php echo $this->Html->image('dwn_share.png'); ?>
							<h3>Comparte</h3>
							<p>Puedes compartir esta informacion con el mundo</p>
						</a>
					</li>
					
					<li class="span3 text-center">
						<a href="<?php echo $this->Html->url('/challenges/view/'); ?>">
							<?php echo $this->Html->image('dwn_app.png'); ?>
							<h3>Baja la aplicacion </h3>
							<p><?php echo $this->Html->link(__('Aplicación movil'), '/pages/mobile', array('style'=>'color:white;') ); ?></p>
						</a>
					</li>
					
					<li class="span3 text-center">
						<a href="<?php echo $this->Html->url('/challenges/view/'); ?>">
							<?php echo $this->Html->image('dwn_signin.png'); ?>	
							<h3>Registrate</h3>
							<p> Puedes registrarte aqui</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>




<!-- RP: Start Blue Space 

<div style="background-color:  #2298C6; min-height:100px; color:#ffffff" >
	<div class="container" >
	  <div class="row">
		  <div class="span12" style="min-height:100px; padding-top:20px;">
		  </div>
	  </div>
	</div>
</div>


-->

