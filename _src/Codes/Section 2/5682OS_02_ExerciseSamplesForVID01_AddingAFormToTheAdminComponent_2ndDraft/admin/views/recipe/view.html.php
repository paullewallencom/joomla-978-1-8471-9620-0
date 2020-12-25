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

		parent::display($tpl);
	}
}