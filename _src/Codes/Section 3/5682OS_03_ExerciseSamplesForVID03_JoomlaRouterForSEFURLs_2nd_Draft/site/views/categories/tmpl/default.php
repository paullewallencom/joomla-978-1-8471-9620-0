<?php
defined('_JEXEC') or die;
?>
<div class="item-page goodcook-categories">
<?php   if (!empty($this->items)) { ?>
            <table class="table table-striped" id="categoriesList">
                <thead>
                    <tr>
                        <th width="1%" class="nowrap center">
                            <?php echo JText::_('COM_GOODCOOK_CATEGORIES'); ?>
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
                                <a href="<?php echo JRoute::_('index.php?option=com_goodcook&view=category&id='.$item->slug); ?>">
                                    <?php echo $this->escape($item->title); ?>
                                </a>
                        </td>
                    </tr>
                    <?php }; ?>
                </tbody>
            </table>
<?php
		}
?>
</div>