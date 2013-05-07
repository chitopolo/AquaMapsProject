<div class="surveys view">
<h2><?php  echo __('Encuesta:') . ' ' . $this->Html->link($survey['Challenge']['title'], array('controller' => 'challenges', 'action' => 'view', $survey['Challenge']['id'])); ?></h2>
</div>
<div class="row">
	<div class="span6">
	<?php echo $this->Form->create('Question', array('url' => array('controller' => 'questions', 'action' => 'add', $survey['Survey']['id']))); ?>
		<fieldset>
			<legend><?php echo __('Agregar pregunta'); ?></legend>
		<?php
			echo $this->Form->hidden('survey_id', array('value' => $survey['Survey']['id']));
			echo $this->Form->input('name', array('label' => __('Pregunta'), 'div' => 'input', 'class' => 'span4 mr', 'after' => $this->Form->select('question_type', $questionTypes, array('empty' => false, 'id' => 'question_type', 'class' => 'span2'))));
		?>
		<div id="question_options_container" style="display: none;">
			<h4><?php echo __('Opciones'); ?> <button type="button" id="add_option_btn_0" class="btn mmb" onclick="addOption();"><i class="icon-plus-sign"></i></button></h4>
			<ol id="question_options" class="unstyled">
				<li>					
				<span class="sortHandle"><i class="icon-resize-vertical"></i></span> 
				<?php
				echo $this->Form->text('QuestionOption.0.description', array('placeholder' => __('Etiqueta'), 'class' => 'input-large mmr'));
				echo $this->Form->text('QuestionOption.0.value', array('placeholder' => __('Valor'), 'class' => 'input-small mmr'));
				?>
				<button type="button" id="add_option_btn_<%= optionNumber %>" class="btn btn-danger mmb" onclick="removeOption(this);"><i class="icon-remove-sign icon-white"></i></button>
				</li>
			</ol>
		</div>
		</fieldset>
		<script>
			var newOption = _.template(
				'<span class="sortHandle"><i class="icon-resize-vertical"></i></span> ' + 
				'<input class="input-large mmr" type="text" placeholder="Etiqueta" name="data[QuestionOption][<%= optionNumber %>][description]">' + 
				'<input class="input-small mmr" type="text" placeholder="Valor" name="data[QuestionOption][<%= optionNumber %>][value]"> ' + 
				'<button type="button" id="add_option_btn_<%= optionNumber %>" class="btn mmb btn-danger" onclick="removeOption(this);">' +
				'<i class="icon-remove-sign icon-white"></i></button>'
			);
			
			function addOption() {
				var optionNumber = $("#question_options").find("li").length;
				$("#question_options").append("<li>" + newOption({optionNumber : optionNumber + 1}) + "</li>");
				if (optionNumber > 1) {
					$("#question_options").sortable({
						containment: "parent",
						axis: "y",
						//handle: ".sortHandle",
						cursor: "crosshair"
					});
				}
			}
			
			function removeOption(option) {
				$(option).parents("li").remove();
			}
			
			$("#question_type").change(function(event) {
				if ($(this).val() > 4) {
					$("#question_options").fadeIn("slow");
				} else {
					$("#question_options").hide();
				}
			});
		</script>
	<?php echo $this->Form->submit(__('Agregar'), array('class' => 'btn btn-large btn-primary')); ?>
	<?php echo $this->Form->end(); ?>
	</div>
	<div class="span5 offset1">
		<h3><?php echo __('Preguntas'); ?></h3>
		<?php if (!empty($survey['Question'])): ?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
			$i = 0;
			foreach ($survey['Question'] as $question): ?>
			<tr>
				<td><?php echo $question['id']; ?></td>
				<td><?php echo $question['survey_id']; ?></td>
				<td><?php echo $question['unit_id']; ?></td>
				<td><?php echo $question['name']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'questions', 'action' => 'view', $question['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'questions', 'action' => 'edit', $question['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'questions', 'action' => 'delete', $question['id']), null, __('Are you sure you want to delete # %s?', $question['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	</div>
</div>
