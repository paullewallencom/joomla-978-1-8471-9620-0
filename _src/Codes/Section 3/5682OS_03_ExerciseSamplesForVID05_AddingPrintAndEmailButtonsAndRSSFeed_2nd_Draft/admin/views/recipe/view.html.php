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
		JFactory::getApplication()->input->set('hidemainmenu', true);
		$isNew		= ($this->item->id == 0);
        JToolbarHelper::title(JText::_('COM_GOODCOOK_MANAGER_RECIPE'), 'recipe.png');
		// Build the actions for new and existing records.
		JToolbarHelper::apply('recipe.apply');
		JToolbarHelper::save('recipe.save');
		JToolbarHelper::cancel('recipe.cancel');
		JToolbarHelper::divider();
		JToolbarHelper::help('JHELP_COMPONENTS_GOODCOOK_RECIPES_EDIT');
	}

}