<?php
defined('_JEXEC') or die;
class GoodcookViewRecipes extends JViewLegacy
{
	public function display($tpl = null)
	{
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

        if ($user->authorise('core.edit.state', 'com_goodcook')) {
            JToolbarHelper::publish('recipes.publish', 'JTOOLBAR_PUBLISH', true);
            JToolbarHelper::unpublish('recipes.unpublish', 'JTOOLBAR_UNPUBLISH', true);
            JToolbarHelper::checkin('recipes.checkin');
        }

    	// Add a button to allow for batch copy operations
        if ($user->authorise('core.edit'))
        {
			// We make sure the built in modal functionality has been enabled
            JHtml::_('bootstrap.modal', 'collapseModal');
            // Use the globally defined term for Batch operations
            $title = JText::_('JTOOLBAR_BATCH');
            $dhtml = "<button data-toggle=\"modal\" 
							  data-target=\"#collapseModal\" 
							  class=\"btn btn-small\">
						<i class=\"icon-checkbox-partial\" title=\"$title\"></i>
						$title</button>";
            JToolBar::getInstance('toolbar')->appendButton('Custom', $dhtml, 'batch');
        }
        if ($user->authorise('core.admin', 'com_goodcook')){
                JToolBarHelper::preferences('com_goodcook');
        }
	}
}






