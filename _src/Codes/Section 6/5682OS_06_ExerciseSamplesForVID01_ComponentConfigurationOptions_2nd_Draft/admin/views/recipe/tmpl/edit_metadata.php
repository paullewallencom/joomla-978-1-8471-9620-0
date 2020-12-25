<?php
defined('_JEXEC') or die;
foreach ($this->form->getFieldset('metadata') as $field): ?>
			<div class="control-group">
				<div class="control-label"><?php echo $field->label; ?></div>
				<div class="controls"><?php echo $field->input; ?></div>
			</div>
<?php endforeach; 