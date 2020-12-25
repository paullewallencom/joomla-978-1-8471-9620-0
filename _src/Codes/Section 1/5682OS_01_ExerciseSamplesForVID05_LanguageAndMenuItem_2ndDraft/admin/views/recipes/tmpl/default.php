<?php
defined('_JEXEC') or die;
?>
<div class="item-page goodcook-recipes">
<?php   if (empty($this->items)) { ?>
	        <p> <?php echo JText::_('COM_GOODCOOK_NO_RECIPES'); ?></p>
<?php   }
        else { 
            foreach ($this->items as $i => $item) { ?>
	        	<p> <?php echo $this->escape($item->title); ?></p>
<?php   	}
		}
?>
</div>