<?php
defined('_JEXEC') or die;
class GoodcookViewRecipe extends JViewLegacy
{
	public function display($tpl = null) 
	{
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		$this->addToolbar();

  // Set a message for reviewers or authors trying to edit a document they do not own
        $user  = JFactory::getUser();
        if ($this->item->id == 0)
        {
            if ($user->authorise('core.create', 'com_goodcook'))
            {
                JFactory::getApplication()->enqueueMessage("You may not create a recipe, save is disabled", 'error');
            }
        } else {
            $canEdit= false;
            if ($user->authorise('core.edit', 'com_goodcook'))
            {
                $canEdit = true;
            } elseif ($user->authorise('core.edit.own', 'com_goodcook')
                && ($this->item->created_by == $user->id))
            {
                $canEdit = true;
            }
            if (!$canEdit)
            {
                     if ($user->authorise('core.edit.own', 'com_goodcook')) {
                    JFactory::getApplication()->enqueueMessage("Review mode, you may only edit your OWN recipes, not other authors.", 'info');
                } else{
                    JFactory::getApplication()->enqueueMessage("Review mode, you may not edit this recipe.", 'info');
                }
            }

        }

		parent::display($tpl);
	}
	protected function addToolbar()
	{
        $user  = JFactory::getUser();

        JFactory::getApplication()->input->set('hidemainmenu', true);
		$isNew		= ($this->item->id == 0);
        JToolbarHelper::title(JText::_('COM_GOODCOOK_MANAGER_RECIPE'), 'recipe.png');

        if ($isNew) {
            // If the user is allowed to create recipes and this is a new document, give them save buttons
            if ($user->authorise('core.create', 'com_goodcook'))  {
                JToolbarHelper::apply('recipe.apply');
                JToolbarHelper::save('recipe.save');
            }
        } else {
            // If the user is allowed to edit recipes, give them save buttons
            if ($user->authorise('core.edit', 'com_goodcook'))  {
                JToolbarHelper::apply('recipe.apply');
                JToolbarHelper::save('recipe.save');
                // If the user is allowed to edit their own recipes and this is one of their recipes, give them a save button
            } elseif ($user->authorise('core.edit.own', 'com_goodcook')
                    && ($this->item->created_by == $user->id))  {

                JToolbarHelper::apply('recipe.apply');
                JToolbarHelper::save('recipe.save');
            }
        }

  	    // These options don't change data so anyone can use them
		JToolbarHelper::cancel('recipe.cancel');
		JToolbarHelper::divider();
		JToolbarHelper::help('JHELP_COMPONENTS_GOODCOOK_RECIPES_EDIT');
	}

}