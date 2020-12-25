<?php
defined('_JEXEC') or die;
 // load tooltip behavior
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
// javascript ajax keepalive function to avoid timeout logoff
JHtml::_('behavior.keepalive');
// Datepicker for dates
JHtml::_('behavior.calendar');


?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'recipe.cancel' || document.formvalidator.isValid(document.id('goodcook-recipe-form'))) {
			<?php echo $this->form->getField('recipe')->save(); ?>
			Joomla.submitform(task, document.getElementById('goodcook-recipe-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_goodcook&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="goodcook-recipe-form" class="form-validate">
	<div class="row-fluid"> 
		<div class="span10 form-horizontal">

        <!-- Added toolbar save and cancel buttons for frontend -->
        <div class="btn-toolbar">
            <div class="btn-group">
                <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('recipe.save')">
                    <span class="icon-ok"></span>&#160;<?php echo JText::_('JSAVE') ?>
                </button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn" onclick="Joomla.submitbutton('recipe.cancel')">
                    <span class="icon-cancel"></span>&#160;<?php echo JText::_('JCANCEL') ?>
                </button>
            </div>
        </div>
        <!-- end of toolbar -->


	<fieldset> 
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab"><?php echo empty($this->item->id) ? JText::_('COM_GOODCOOK_NEW_RECIPE') : JText::sprintf('COM_GOODCOOK_EDIT_RECIPE', $this->item->id); ?></a></li>
    		
            <li><a href="#metadata" data-toggle="tab"><?php echo JText::_('JGLOBAL_FIELDSET_METADATA_OPTIONS');?></a></li>
            <li><a href="#publishingoptions" data-toggle="tab"><?php echo JText::_('JGLOBAL_FIELDSET_PUBLISHING');?></a></li>
            
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="details">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
				</div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('alias'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('alias'); ?></div>
                </div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('recipe'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('recipe'); ?></div>
				</div>
                <div class="control-group">
                     <div class="control-label"><?php echo $this->form->getLabel('catid'); ?></div>
                     <div class="controls"><?php echo $this->form->getInput('catid'); ?></div>
                </div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
				</div>
			</div>
			<div class="tab-pane" id="metadata">
				<fieldset>
					<?php echo $this->loadTemplate('metadata'); ?>
				</fieldset>
            </div>
			<div class="tab-pane" id="publishingoptions">
				<fieldset>
					<?php echo $this->loadTemplate('publishingoptions'); ?>
				</fieldset>
            </div>
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
    </fieldset>
    
    	</div>


    </div>
</form>