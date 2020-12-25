<?php
defined('_JEXEC') or die;
 
/**
 * Goodcook helper
 */
abstract class GoodcookHelper
{
        /**
         * Configure the Linkbar.
         */
	public static function addSubmenu($vName = 'recipes')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_GOODCOOK_SUBMENU_GOODCOOK'),
			'index.php?option=com_goodcook&view=recipes',
			$vName == 'recipes'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_GOODCOOK_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_goodcook',
			$vName == 'categories'
		);
		if ($vName == 'categories')
		{
			JToolbarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_goodcook')),
				'goodcook-categories');
		}
	}
}