<?php
defined('_JEXEC') or die;
class GoodcookViewRecipe extends JViewLegacy
{
	public function display($tpl = null)
	{
		// Get some data from the models
		$item		= $this->get('Item');
		$this->item      = &$item;
		
		parent::display($tpl);
	}
}