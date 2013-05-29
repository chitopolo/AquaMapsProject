<div class="surveys view">
<h2><?php  echo __('Encuesta:') . ' ' . $this->Html->link($survey['Challenge']['title'], array('controller' => 'challenges', 'action' => 'view', $survey['Challenge']['id'])); ?></h2>
</div>
<div class="row">
	<div class="span5">
	<?php echo $this->Form->create('Question', array('id' => 'add_question_form', 'class' => 'box-mod mt', 'url' => array('controller' => 'questions', 'action' => 'add', $survey['Survey']['id']))); ?>
		<fieldset>
			<legend><?php echo __('Agregar pregunta'); ?></legend>
		<?php
			echo $this->Form->hidden('survey_id', array('value' => $survey['Survey']['id']));
			echo $this->Form->input('name', array('label' => false, 'placeholder' => __('Escribe una pregunta aquí'), 'div' => 'input', 'id' => 'question_text', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => __('No olvides escribir la pregunta!'), 'class' => 'span3', 'after' => ' ' . $this->Form->select('question_type_id', $questionTypes, array('empty' => false, 'id' => 'question_type', 'class' => 'input-medium'))));
		?>
		<div id="question_options_container" style="display: none;">
			<h5><?php echo __('Opciones'); ?></h5>
			<ol id="question_options" class="unstyled">
				<!--<li>
				<?php
				echo $this->Form->text('QuestionOption.0.description', array('placeholder' => __('Etiqueta'), 'class' => 'input-large mmr'));
				echo $this->Form->text('QuestionOption.0.value', array('placeholder' => __('Valor'), 'class' => 'input-small mmr'));
				?>
				<span class="sortHandle"><i class="icon-resize-vertical"></i></span> 
				<i class="icon-remove-sign clickable" onclick="removeOption(this);"></i>
				</li>-->
			</ol>
			<p><button type="button" id="add_option_btn_0" class="btn btn-small mmb" onclick="addOption();">Agregar opción <i class="icon-plus-sign"></i></button></p>
			
		</div>
		</fieldset>
		<script>
			$(document).ready(function() {
				$("#question_type").trigger("change");
			});

			var newOption = _.template(
				'<input class="input-large mmr" type="text" placeholder="Etiqueta" name="data[QuestionOption][<%= optionNumber %>][description]">' + 
				'<input class="input-small mmr" type="text" placeholder="Valor" name="data[QuestionOption][<%= optionNumber %>][value]"> ' + 
				'<span class="sortHandle"><i class="icon-resize-vertical"></i></span> ' + 
				'<i class="icon-remove-sign clickable" onclick="removeOption(this);"></i>'
			);
			
			function addOption() {
				var optionNumber = $("#question_options").find("li").length;
				$("#question_options").append("<li>" + newOption({optionNumber : optionNumber + 1}) + "</li>");
				if (optionNumber > 0) {
					$("#question_options").sortable({
						containment: "parent",
						axis: "y",
						//handle: ".sortHandle",
						cursor: "crosshair"
					});
				}
				validateQuestionForm();
			}
			
			function removeOption(option) {
				$(option).parents("li").remove();
				if ($("#question_options li").length == 0) {
					$("#question_type").val("1");
				}
			}
			
			function validateQuestionForm() {
				var errors = 0;
				
				if ($("#question_text").val() == "") {
					$("#question_text").effect("highlight");
					$('#question_text').tooltip('show');
					errors++;
				}
				
				if ($("#question_type") > 4) {					
					$("#question_options input").each(function(index, value) {
						if ($(value).val() == "") {
							$(value).effect("highlight");
							errors++;
						}
					});
				}
				
				if (errors > 0) {
					return false;
				} else {
					return true;
				}
			}
			
			$("#question_type").change(function(event) {
				if ($(this).val() > 4) {
					$("#question_options_container").fadeIn("slow");
					if ($("#question_options li").length == 0) {
						addOption();
					}
				} else {
					$("#question_options_container").fadeOut("slow");
				}
			});
			
			$("#add_question_form").submit(function(event) {
				return validateQuestionForm();
			});
		</script>
	<?php echo $this->Form->submit(__('Agregar'), array('class' => 'btn btn-large btn-primary', 'div' => 'text-right')); ?>
	<?php echo $this->Form->end(); ?>
	</div>
	<div class="span6 offset1">
		<?php //pr($survey); ?>
	<?php if (!empty($survey['Question'])): ?>
		<h3><?php echo __('Preguntas'); ?></h3>
		<table class="table">
			<colgroup>
				<col width="10%" />
				<col width="50%" />
				<col width="30%" />
				<col width="10%" />
			</colgroup>
			<tbody>
		<?php $i = 1; ?>
		<?php foreach ($survey['Question'] as $question): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $question['name']; ?></td>
				<td>
				<?php if (!empty($question['QuestionOption'])): ?>
					<ul class="unstyled">
					<?php foreach ($question['QuestionOption'] as $questionOption): ?>
						<li><?php echo $questionOption['description']; ?> - <?php echo $questionOption['value']; ?></li>
					<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				</td>
				<td class="actions">
					<?php echo $this->Form->postLink(__('Quitar'), array('controller' => 'questions', 'action' => 'delete', $question['id']), null, __('Seguro que quieres esta pregunta?')); ?>
				</td>
				<?php $i++; ?>
			</tr>
		<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<h3 class="text-center muted"><?php echo __('Esta encuesta no tiene preguntas todavía'); ?></h3>
	<?php endif; ?>
	</div>
</div>
