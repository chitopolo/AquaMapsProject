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