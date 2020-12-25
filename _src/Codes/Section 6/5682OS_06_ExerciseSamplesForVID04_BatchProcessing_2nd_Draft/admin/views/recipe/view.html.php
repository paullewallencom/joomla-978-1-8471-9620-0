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