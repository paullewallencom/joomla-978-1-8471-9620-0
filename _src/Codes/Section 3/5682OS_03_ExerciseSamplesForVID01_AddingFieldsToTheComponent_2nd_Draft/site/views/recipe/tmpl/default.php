<?php
defined('_JEXEC') or die;
?>
<div class="item-page goodcook-recipe">
<?php   if (empty($this->item)) { ?>
	        <p><?php echo JText::_('COM_GOODCOOK_NO_RECIPE'); ?></p>
<?php   }
        else {  ?>
	    	<h3><?php echo $this->item->title; ?></h3>
            <p><?php echo $this->item->recipe; ?></p>
<?php   }
?>
</div>