<?php  
defined('_JEXEC') or die; 
class GoodcookViewRecipe extends JViewLegacy 
{
	public function display($tpl = null)
	{
        // Get the currently logged on user
        $user = JFactory::getUser();

        // Make sure our user is allowed to view this item.  Note: this method always returns true for the super user!
        if (!$user->authorise('recipe.view', 'com_goodcook'))
        {
            $app = JFactory::getApplication();
            $app->redirect(
                JRoute::_(
                    'index.php?option=com_goodcook&view=recipes', false
                ),
                JText::_('COM_GOODCOOK_VIEW_NOT_AUTHORIZED'),
                'error');


            return false;
        }

		// Get some data from the models
		$item		= $this->get('Item');
		$this->item      = &$item;

		//determine if this is a print screen
		$app = JFactory::getApplication(); 
		$this->print = $app->input->getBool('print');

		//set meta description
		if ($this->item->metadesc) {
			$this->document->setDescription($this->item->metadesc);
		}
		
		$componentParams        = JComponentHelper::getParams('com_goodcook');

		// Copy the application parameters for merging
		$menuParams = new JRegistry;

		// Find the active menu
		$active = $app->getMenu()->getActive();
		$currentLink = $active->link;
		$menuParams->loadString($active->params);

		if ($active && (strpos($currentLink, 'view=recipe') && (strpos($currentLink, '&id='.(string) $item->id)))) {
			// If the current view is the active item AND the recipe view for this recipe, then the menu item params take priority
				// $item->params are the recipe params, $mergeParams are the menu item params
				// Merge so that the menu item params take priority
            $componentParams->merge($menuParams);
            $this->params  = $componentParams->toArray();
		}
		else {
		   // Merge so that recipe params take priority
			$menuParams->merge($componentParams);
            $this->params  = $menuParams->toArray();
		}
		
		//set metakeywords
		if ($this->item->metakey) {
			$this->document->setMetadata('keywords', $this->item->metakey);
		}

		$title = $this->document->getTitle() . " - " . $this->item->title;
		$this->document->setTitle($title);

	
		parent::display($tpl);
	}
}