<?php
defined('_JEXEC') or die;
?>

<form action="<?php echo JRoute::_('index.php?option=com_goodcook&view=goodcook.recipe'); ?>" method="post" name="adminForm" id="adminForm">
	<div id="j-main-container">
		<table class="table table-striped" id="recipesList">
			<thead>
				<tr>
					<th width="1%" class="">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
					<th class="title">
						<?php echo JText::_('JGLOBAL_TITLE'); ?>
					</th>
					<th width="1%" class="nowrap center">
						<?php echo JText::_('JGRID_HEADING_ID'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($this->items as $i => $item) { ?>
				<tr class="row<?php echo $i % 2; ?>" >
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td class="nowrap">
							<a href="<?php echo JRoute::_('index.php?option=com_goodcook&view=recipe&layout=edit&id='.(int) $item->id); ?>">
								<?php echo $this->escape($item->title); ?>
							</a>
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
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>