<?php
defined('_JEXEC') or die;

?>
<div class="modal hide fade" id="collapseModal">
	<div class="modal-header">
		<button type="button" role="presentation" class="close" data-dismiss="modal">x</button>
		<h3>Choose Category to copy recipes into</h3>
	</div>
	<div class="modal-body">

		<div class="control-group">
			<div class="controls">
            <div id="batch-move-copy" class="control-group radio">
                <div class="controls">
                    <label for="batch[move_copy]c" id="batch[move_copy]c-lbl" class="radio">
                    
                    <input type="radio" name="batch[move_copy]" id="batch[move_copy]c" value="c"  >Copy
                    </label>
                    <label for="batch[move_copy]m" id="batch[move_copy]m-lbl" class="radio">
                    
                    <input type="radio" name="batch[move_copy]" id="batch[move_copy]m" value="m"  checked="checked" >Move
                    </label>
                </div>
            </div>
            <hr />
                <select
                    name="batch[category_id]"
                    class="inputbox"
                    id="batch-category-id"
                    >
                    <option value="">
                        <?php
                        // Default/initial option is globally defined select one text
                        echo JText::_('JSELECT');
                        ?>
                     </option>
                    <?php
                    // Get the categories for this component
                    $categories = JHtml::_('category.options', 'com_goodcook');
                    // Generate select options for the categories
                    echo JHtml::_('select.options', $categories);

                    ?>
                    </select>
			</div>
		</div>

	</div>
	<div class="modal-footer">
		<button class="btn" type="button" onclick="document.id('batch-category-id').value='';document.id('batch-access').value='';document.id('batch-language-id').value=''" data-dismiss="modal">
			<?php echo JText::_('JCANCEL'); ?>
		</button>
		<button class="btn btn-primary" type="submit" onclick="Joomla.submitbutton('recipe.batch');">
			<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
		</button>
	</div>
</div>









