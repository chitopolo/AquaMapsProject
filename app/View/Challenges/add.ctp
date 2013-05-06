<?php echo $this->Html->css(array('chosen')); ?>
<?php echo $this->Html->script(array('chosen.jquery.min')); ?>
<div class="challenges form">
<?php echo $this->Form->create('Challenge', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Nuevo reto'); ?></legend>
	<?php
		echo $this->Form->hidden('user_id', array('value' => $current['User']['id']));
		echo $this->Form->input('title', array('label' => __('Título'), 'class' => 'input-xlarge'));
		echo $this->Form->input('invitation', array('label' => __('Descripción corta'), 'type' => 'textarea', 'class' => 'input-xlarge'));
		echo $this->Form->input('description', array('label' => __('Descripción larga'), 'type' => 'textarea', 'class' => 'input-xlarge'));
		echo $this->Form->input('image', array('label' => __('Imagen'), 'type' => 'file'));
	?>
	</fieldset>
	<fieldset>
		<legend><?php echo __('Alcance del reto'); ?></legend>
		<div class="row">
			<div class="span">
				<?php
					echo $this->Form->input('country_id', array('id' => 'countries', 'class' => 'chosen', 'emtpy' => true));
				?>
			</div>
			<div class="span">
				<?php
					echo $this->Form->input('region_id', array('id' => 'regions', 'class' => 'chosen', 'emtpy' => true));
				?>
			</div>
			<div class="span">
				<?php
					echo $this->Form->input('city_id', array('id' => 'cities', 'class' => 'chosen', 'emtpy' => true));
				?>
			</div>
		</div>
	<script>
		$("#countries").change(function() {
			fillSelect("#countries", "#cities", "api/cities.json?country_id=");
		});
		function fillSelect(parentSelector, childSelector, requestUrl) {
			var child = $(childSelector);		
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
							$.each(data.cities, function(index, value) {
								child.append('<option value="' + index + '">' + value + '</option>');
							});
							child.trigger("liszt:updated");
						}
					}
				},
				url: "<?php echo $this->Html->url('/'); ?>" + requestUrl + "" + $(parentSelector).val()
			});
		}

		$(".chosen").chosen();
	</script>
	<legend><?php echo __('Datos'); ?></legend>
	<?php
		echo $this->Form->input('Survey.0.name', array('label' => 'Nombre cuestionario:'));
		echo $this->Form->input('Survey.0.Question.0.name', array('label' => 'Pregunta:'));
		echo $this->Form->input('Survey.0.Question.0.unit_id', array('label' => 'Unidad:'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Challenges'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Surveys'), array('controller' => 'surveys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey'), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
	</ul>
</div>
