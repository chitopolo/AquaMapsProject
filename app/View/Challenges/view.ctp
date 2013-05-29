<?php echo $this->Html->script(array('jquery.knob')); ?>
<h1><?php echo h($challenge['Challenge']['title']); ?></h1>

<div class="row">
	<?php
	if (!empty($challenge['Challenge']['image'])) {
		$imageFile = $this->Html->url('/img/challenges/' . $challenge['Challenge']['image']);
	} else {
		$imageFile = $this->Html->url('/img/placeholders/ch_ph_view.jpg');
	}
	?>
	<div class="span8">
		<div class="challenge-image">
			<img src="<?php echo $imageFile; ?>" alt="<?php echo $challenge['Challenge']['title']; ?>">
			<h3><?php echo h($challenge['Challenge']['invitation']); ?></h3>
		</div>
	</div>
	<div class="span4">
		<?php echo h($challenge['Challenge']['description']); ?>
		<hr />
		<h4><?php echo __('Alcance'); ?></h4>
		<?php
		$scope = '';
		$scope .= !empty($challenge['City']['name']) ? $challenge['City']['name'] . ', ' : '';
		$scope .= !empty($challenge['Region']['name']) ? $challenge['Region']['name'] . ', ' : '';
		$scope .= $challenge['Country']['name'];
		?>
		<p class="lead"><?php echo $scope; ?></p>
		<hr />
		<div class="row">


			<div class="span4">

				<div class="btn-group">

				<a class="btn btn-large btn-success" href="<?php echo $this->Html->url('/pages/mobile') ?>" type="button">Colabora</a>

				<a class="btn btn-large btn-primary" href="<?php echo $this->Html->url('/DataSets/wizard') ?>" type="button">Sube datos</a>

				<?php if($challenge['Challenge']['id'] == 2) { ?>
					<a class="btn btn-large btn-warning" href="<?php echo $this->Html->url('/DataSets/view2') ?>" type="button">Data Sets</a>
				<?php } elseif ($challenge['Challenge']['id'] == 3) { ?>
					<a class="btn btn-large btn-warning" href="<?php echo $this->Html->url('/DataSets/view3') ?>" type="button">Data Sets</a>		
				<?php }?>

				</div>

			</div>
		</div>
		<hr>

		<div class="row">
			<div class="span2 text-center">
				<h4>Aportes</h4>
				<input type="text" value="60" class="dial" readonly="readonly" data-readonly="true" data-width="100" data-thickness=".3" data-fgColor="#00CC33">
			</div>
			<div class="span2 text-center">
				<h4>Likes</h4>
				<input type="text" value="77" class="dial" readonly="readonly" data-readonly="true" data-width="100" data-thickness=".3" data-fgColor="#2298C6">
			</div>
		</div>


		<script>
		$(function() {
			$(".dial").knob();
		});
		</script>
	</div>
</div>

<div class="row">
	<div class="span12">
		<h2> Resultados </h2>
	</div>
</div>

<?php 
	if($challenge['Challenge']['id'] == 3) {
		echo $this->element('data_set'); 
	}
?>
<legend><h4> Organizaciones </h4> </legend>
<div class="row">
	<div class="span2">
		<img src="<?php echo $this->Html->url('/img/CochaValleyLogo.png') ?>" width="150px">
	</div>
	<?php if($challenge['Challenge']['id'] == 1 || $challenge['Challenge']['id'] == 3) { ?>
		<div class="span2">
			<img src="<?php echo $this->Html->url('/img/ALCALDIA COCHABAMBA.jpg') ?>" width="150px">
		</div>
	<?php } else { ?>
		<!--
		<div class="span2">
			<img src="<?php echo $this->Html->url('/img/bancoMundial.jpg') ?>" width="150px">
		</div>
		-->
	<?php }  ?>
</div>