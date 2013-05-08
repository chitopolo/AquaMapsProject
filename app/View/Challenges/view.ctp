<?php echo $this->Html->script(array('raphael.2.1.0.min', 'justgage.1.0.1.min')); ?>
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
			<div class="span2 text-center">
				<div id="gauge_1"></div>
			</div>
			<div class="span2 text-center">
				<div id="gauge_2"></div>
			</div>
		</div>
		<script>
		var g1 = new JustGage({
			id: "gauge_1", 
			value: 81, 
			min: 0,
			max: 100,
			title: "Likes",
			showMinMax: false,
			levelColors: [
				"#00CC33"
			]  
		});

		var g2 = new JustGage({
			id: "gauge_2", 
			value: 67, 
			min: 0,
			max: 100,
			title: "Aportes",
			showMinMax: false,
			levelColors: [
				"#2298C6"
			]  
		}); 
		</script>
	</div>
</div>