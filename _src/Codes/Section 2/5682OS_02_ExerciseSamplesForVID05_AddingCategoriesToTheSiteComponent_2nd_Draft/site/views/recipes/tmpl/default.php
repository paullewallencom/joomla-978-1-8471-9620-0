<?php
defined('_JEXEC') or die;
?>
<div class="item-page goodcook-recipes">
<?php   if (!empty($this->items)) { ?>

            <table class="table table-striped" id="recipesList">
                <thead>
                    <tr>
                        <th class="title">
                            <?php echo JText::_('COM_GOODCOOK_RECIPE_TITLE'); ?>
                        </th>
                        <th width="1%" class="nowrap center">
                            <?php echo JText::_('COM_GOODCOOK_CATEGORY'); ?>
                        </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                      <td colspan="9"><?php echo $this->pagination->getListFooter(); ?></td>
                    </tr>
                </tfoot>
                <tbody>
                <?php foreach ($this->items as $i => $item) { ?>
                    <tr class="row<?php echo $i % 2; ?>" >
                        <td>
                                <a href="<?php echo JRoute::_('index.php?option=com_goodcook&view=recipe&id='.(int) $item->id); ?>">
                                    <?php echo $this->escape($item->title); ?>
                                </a>
                        </td>
                        <td class="left">
                            <?php echo $item->category_title; ?>
                        </td>
                    </tr>
                    <?php }; ?>
                </tbody>
            </table>
<?php
		}
?>
</div>