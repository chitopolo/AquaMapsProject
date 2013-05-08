<?php echo $this->Html->css(array('chosen')); ?>
<?php echo $this->Html->script(array('chosen.jquery.min')); ?>
<h1><?php echo __('Crea un nuevo reto'); ?></h1>
<div class="row">
	<div class="span10 offset1">
<?php echo $this->Form->create('Challenge', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Alcance del reto'); ?></legend>
		<div class="row">
			<div class="span3">
				<?php
					echo $this->Form->input('country_id', array('id' => 'countries', 'class' => 'chosen', 'emtpy' => true));
				?>
			</div>
			<div class="span3">
				<?php
					echo $this->Form->input('region_id', array('id' => 'regions', 'class' => 'chosen', 'emtpy' => true));
				?>
			</div>
			<div class="span3">
				<?php
					echo $this->Form->input('city_id', array('id' => 'cities', 'class' => 'chosen', 'emtpy' => true));
				?>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend><?php echo __('Nuevo reto'); ?></legend>
	<?php
		echo $this->Form->hidden('user_id', array('value' => $current['User']['id']));
		echo $this->Form->input('title', array('label' => __('Título'), 'class' => 'input-xlarge'));
		echo $this->Form->input('invitation', array('label' => __('Descripción corta'), 'class' => 'input-xlarge'));
		echo $this->Form->input('description', array('label' => __('Descripción larga'), 'type' => 'textarea', 'class' => 'input-xlarge'));
		echo $this->Form->input('image', array('label' => __('Imagen'), 'type' => 'file'));
	?>
	</fieldset>
	<script>
		$("#countries").change(function() {
			fillSelect({
				parentSelector: "#countries",
				childSelector: "#regions",
				requestUrl: "api/regions.json?country_id=",
				responseCollection: "regions"
			});
		});

		$("#regions").change(function() {
			fillSelect({
				parentSelector: "#regions",
				childSelector: "#cities",
				requestUrl: "api/cities.json?region_id=",
				responseCollection: "cities"
			});
		});

		function fillSelect(options) {
			var child = $(options.childSelector);
			$.ajax({
				async: true,
				beforeSend: function (XMLHttpRequest) {
					//$("#cities").;
				},
				complete: function (XMLHttpRequest) {
					//$(event.target).find("input").removeAttr('disabled');
				},
				buffer: false,
				//data: $(event.target).closest("form").serialize(),
				inline: true,
				success: function (data, textStatus) {
					if (data != "") {
						try {
							var isJSON = true;
						} catch (e) {
							var isJSON = false;
						}
	
						if (isJSON && data.status == 1) {
							child.find("option").remove();
							child.append('<option value=""></option>');
							var collection = data[options.responseCollection];
							$.each(collection, function(index, value) {
								child.append('<option value="' + index + '">' + value + '</option>');
							});
							child.trigger("liszt:updated");
						}
					}
				},
				url: "<?php echo $this->Html->url('/'); ?>" + options.requestUrl + "" + $(options.parentSelector).val()
			});
		}

		$(".chosen").chosen();
	</script>
<?php echo $this->Form->submit(__('Crear reto!'), array('class' => 'btn btn-large btn-primary')); ?>
<?php echo $this->Form->end(); ?>
	</div>
</div>
<!--<div class="actions">-->
<!--	<h3><?php echo __('Actions'); ?></h3>-->
<!--	<ul>-->
<!--		<li><?php echo $this->Html->link(__('List Challenges'), array('action' => 'index')); ?></li>-->
<!--		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('List Surveys'), array('controller' => 'surveys', 'action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New Survey'), array('controller' => 'surveys', 'action' => 'add')); ?> </li>-->
<!--	</ul>-->
<!--</div>-->