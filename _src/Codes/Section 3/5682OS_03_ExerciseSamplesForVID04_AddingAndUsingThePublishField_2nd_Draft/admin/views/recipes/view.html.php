<?php
defined('_JEXEC') or die;
class GoodcookViewRecipes extends JViewLegacy
{
	public function display($tpl = null)
	{
     require_once JPATH_COMPONENT.'/helpers/goodcook.php';

		// Get some data from the models
		$items		= $this->get('Items');
		$this->items      = &$items;
		
		$pagination = $this->get('Pagination');
		$this->pagination = $pagination;		
		//Set the toolbar
		$this->addToolBar();
		
		// get the sidebar
		GoodcookHelper::addSubmenu('recipes');
		$this->sidebar = JHtmlSidebar::render(); 
		parent::display($tpl);
	}
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_GOODCOOK_MANAGER_RECIPES'));
		JToolBarHelper::addNew('recipe.add');
		JToolBarHelper::editList('recipe.edit');
		JToolBarHelper::deleteList('', 'recipes.delete');
		JToolbarHelper::publish('recipes.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('recipes.unpublish', 'JTOOLBAR_UNPUBLISH', true);

	}
}