<div class="dataSets form">
<?php echo $this->Form->create('DataSet',array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Importar datos'); ?></legend>
	<?php
		echo $this->Form->input('parent_id', array('label' => 'Data set asociado'));
		echo $this->Form->input('challenge_id', array('label' => 'Asociado al reto'));
		echo $this->Form->input('data_set_type_id', array('label' => 'Tipo'));
		echo $this->Form->input('name' , array('label' => 'Nombre'));
		echo $this->Form->input('mappable', array('label' => 'Mapeable?'));
		echo $this->Form->input('file', array('label' => __('Archivo'), 'type' => 'file'));
	?>
	</fieldset>
	<?php echo $this->Form->submit(__('Subir datos!'), array('class' => 'btn btn-large btn-primary')); ?>

<?php echo $this->Form->end(); ?>
</div>