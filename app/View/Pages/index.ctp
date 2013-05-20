
<!-- RP: Start Blue Space -->
<div style="background-color:  #2298C6; text-color:#ffffff; box-shadow: 0 3px 2px rgba(0, 0, 0, 0.15);" >
	<div class="container-fluid" >
		<div class="row-fluid">
			<div class="span4" style="text-align: rigth;">
				<br>
				<?php echo $this->Html->image('text-hero.png', array('width' => 350, 'alt' => __('Aquamaps'))); ?>
				<br>
				<a style="float: right;" href="<?php echo $this->Html->url('/'); ?>"><?php echo $this->Html->image('logo_aquamaps.png', array('width' => 200, 'alt' => __('Aquamaps'))); ?></a>
			</div>
			<div class="span8">
			<br>
			<div id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                  <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                  	<a href="pages/explore">
                    <img src="img/0.png" alt="">
                    <div class="carousel-caption">
                      <h4>Explora los datos</h4>
                      <p>
                      	Explora los data sets disponibles de saneamiento en LatinoAmerica
                      </p>
                    </div>
					</a>
                  </div>
                  <div class="item">
                  	<a href="http://www.hackatonsaneamiento.la/equipo-aquamapas/" target="_blank">
                    <img src="img/hackathonfin.png" alt="">
                    <div class="carousel-caption">
                      <h4>Finalista del Hackathon de Saneamiento</h4>
                      <p>AquaMapas esta entre los finalistas del hackathon de Saneamiento. Apoya con tu voto para este proyecto.</p>
                    </div>
                	</a>

                  </div>
                  <div class="item">
              	    <a href="http://localhost/AquaMapsProject/pages/api" target="_blank">
                    <img src="img/0.png" alt="">
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


</div>

<div>
	<br>
	<h1 class="cleasrfix mb"><?php echo __('Retos destacados'); ?></h1>

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
</div>


<!-- RP: Ends Blue Space -->



<div style="background-color:  #2298C6; text-color:#ffffff" >
	<div class="container-fluid" >
		<div class="row-fluid">
			<div class="span12">
			<h2 id="ayudar" style="color:white;">Como puedes ayudar?</h2>

<ul class="thumbnails">
  <li class="span3">
    <div class="img-rounded">
    <?php   echo $this->Html->image('person.png', array('class' => 'media-object', 'width' => 300));  ?>
      <h3  style="color:white;"> Recolecta datos</h3>
      <p  style="color:white;"> If you are part of an organization that works with santitation and water projects. And even if your a indvidual that is traveling. You can help us by collect data with your mobile app.</p>
    </div>
  </li>
<li class="span3">
    <div class="img-rounded">
      <?php   echo $this->Html->image('person.png', array('class' => 'media-object', 'width' => 300));  ?>
      <h3  style="color:white;">Comparte</h3>
      <p  style="color:white;">Puedes compartir esta informacion con el mundo</p>
    </div>
  </li>
<li class="span3">
    <div class="img-rounded">
     <?php   echo $this->Html->image('person.png', array('class' => 'media-object', 'width' => 300));  ?>

      <h3  style="color:white;">Registrate</h3>
      <p  style="color:white;"> Puedes registrarte aqui
</p>
    </div>
  </li>

<li class="span3">
    <div class="img-rounded">
     <?php   echo $this->Html->image('person.png', array('class' => 'media-object', 'width' => 300));  ?>

      <h3  style="color:white;">Baja la aplicacion </h3>
      <p  style="color:white;">  <?php echo $this->Html->link(__('Aplicación movil'), '/Pages/mobile', array('style'=>'color:white;') ); ?>
</p>
    </div>
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

