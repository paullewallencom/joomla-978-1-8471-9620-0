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
        $user  = JFactory::getUser();

		JToolBarHelper::title(JText::_('COM_GOODCOOK_MANAGER_RECIPES'));

        if ($user->authorise('core.create', 'com_goodcook')) {
            JToolBarHelper::addNew('recipe.add');
        }

        if ($user->authorise('core.edit', 'com_goodcook')
        || $user->authorise('core.edit.own', 'com_goodcook')) {
            JToolBarHelper::editList('recipe.edit');
        }

        if ($user->authorise('core.delete', 'com_goodcook')
            || $user->authorise('core.delete.own', 'com_goodcook')) {
            JToolBarHelper::deleteList('', 'recipes.delete');
        }

        if ($user->authorise('core.admin', 'com_goodcook')){
                JToolBarHelper::preferences('com_goodcook');
        }
    
    
    }
}