<?php
defined('_JEXEC') or die;

class GoodcookViewRecipes extends JViewLegacy
{
	public function display($tpl = null)
	{
		// Get some data from the models
		$items		= $this->get('Items');
		$this->items      = &$items;
		
		parent::display($tpl);
	}
}