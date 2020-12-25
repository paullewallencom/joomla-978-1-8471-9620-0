<?php
defined('_JEXEC') or die;
?>
<form action="<?php echo JRoute::_('index.php?option=com_goodcook&view=goodcook.recipe'); ?>" method="post" name="adminForm" id="adminForm">

<?php if(!empty($this->sidebar)): ?>
 <div id="j-sidebar-container" class="span2">
  <?php echo $this->sidebar; ?>
 </div>
 <div id="j-main-container" class="span10">
  <?php else : ?>
  <div id="j-main-container">
   <?php endif;?>

		<table class="table table-striped" id="recipesList">
			<thead>
				<tr>
					<th width="1%" class="">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
                    <th width="1%" style="min-width:55px" class="nowrap center">
                        <?php echo JText::_('JSTATUS'); ?>
                    </th>
					<th class="title">
						<?php echo JText::_('JGLOBAL_TITLE'); ?>
					</th>
					<th width="1%" class="nowrap center">
						<?php echo JText::_('JGRID_HEADING_ID'); ?>
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
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
                    <td class="center">
                        <?php echo JHtml::_('jgrid.published', $item->published, $i, 'recipes.', true, 'cb', $item->publish_up, $item->publish_down); ?>
                    </td>
					<td class="nowrap">
							<a href="<?php echo JRoute::_('index.php?option=com_goodcook&view=recipe&task=recipe.edit&layout=edit&id='.(int) $item->id); ?>">
								<?php echo $this->escape($item->title); ?>
							</a>
                            <div class="small">
								<?php echo $this->escape($item->category_title); ?>
							</div>
					</td>
					<td class="center">
						<?php echo (int) $item->id; ?>
					</td>
				</tr>
				<?php }; ?>
			</tbody>
		</table>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="view" value="recipes" />
		<?php echo JHtml::_('form.token'); 
			//load the hidden batch processing form.
			echo $this->loadTemplate('batch'); 
		?>
	</div>
</form>





