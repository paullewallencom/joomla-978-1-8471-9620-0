<?php 
defined('_JEXEC') or die;
class GoodcookViewForm extends JViewLegacy
{
	public function display($tpl = null) 
	{
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
        $user = JFactory::getUser();

		if (empty($this->item->id)) {
			$authorised = ($user->authorise('core.create', 'com_goodcook') || 
				(count($user->getAuthorisedCategories('com_goodcook', 'core.create'))));
		}
		else {
			$authorised = $user->authorise('core.edit', 'com_goodcook.recipe'.$this->item->id);
		}

		if ($authorised !== true) {
			JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
			return false;
		}

		if (!empty($this->item)) {
			$this->form->bind($this->item);
		}

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		$componentParams        = JComponentHelper::getParams('com_goodcook');

		// Get params
		$menuParams = new JRegistry;
		$app = JFactory::getApplication(); 
		$active = $app->getMenu()->getActive();
		$currentLink = $active->link;
		$menuParams->loadString($active->params);
		if ($active && (strpos($currentLink, 'view=recipe') && 
				(strpos($currentLink, '&id='.(string) $item->id)))) {
            $componentParams->merge($menuParams);
            $this->params  = $componentParams->toArray();
		}
		else {
			$menuParams->merge($componentParams);
            $this->params  = $menuParams->toArray();
		}	

		$this->user		= $user;

		//set metakeywords
		if ($this->item->metakey) {
			$this->document->setMetadata('keywords', $this->item->metakey);
		}

		$title = $this->document->getTitle() . " - " . $this->item->title;
		$this->document->setTitle($title);

        // Load the admin language file as we use globally defined text strings from there
        JFactory::getLanguage()->load('joomla', JPATH_ADMINISTRATOR);

		parent::display($tpl);
	}
}