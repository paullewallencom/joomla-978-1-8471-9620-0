<?php

defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

?>

<div class="item-page goodcook-recipe">

<?php   if (empty($this->item)) { ?>

	        <p><?php echo JText::_('COM_GOODCOOK_NO_RECIPE'); ?></p>

<?php   }

        else {  ?>

		<?php if (!$this->print) { ?>
    
                <div class="btn-group pull-right">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> 
                    	<i class="icon-cog"></i> 
                        <span class="caret"></span> 
                    </a>
                    <ul class="dropdown-menu actions">
                            <li class="print-icon"> 
								<?php echo JHtml::_('icon.print_popup', $this->item, $params); ?> 
                            </li>
                            <li class="email-icon"> 
								<?php echo JHtml::_('icon.email', $this->item, $params); ?> 
                            </li>
                    </ul>
                </div>
            <?php 
			} 
			else { ?>
				<div class="pull-right">
					<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
				</div>
			<?php 
            } ?>

	    	<h3><?php echo $this->item->title; ?></h3>

            <p><?php echo $this->item->recipe; ?></p>





            <div class="recipe-submission-info">

                <div class="recipe-author">

                	<span class="gc-label">

                    	<?php echo JText::_('COM_GOODCOOK_RECIPE_AUTHOR'); ?>

                    </span>

                    <span class="gc-data">

                    	<?php echo $this->item->author; ?>

                    </span>

                </div>

                <div class="recipe-created-date">

                	<span class="gc-label">

                    	<?php echo JText::_('COM_GOODCOOK_RECIPE_CREATED_DATE'); ?>

                    </span>

                    <span class="gc-data">

                    	<?php echo date('M j, Y', strtotime($this->item->created));  ?>

                    </span>

                </div>

                <div style="clear:both;"></div>

            </div>       





<?php   }

?>

</div>