<?php
defined('_JEXEC') or die;
class GoodcookViewCategory extends JViewLegacy
{
	public function display($tpl = null)
	{
		// Get some data from the models
		$items		= $this->get('Items');
		$this->items      = &$items;
		
		$pagination = $this->get('Pagination');
		$this->pagination = $pagination;		

		parent::display($tpl);
	}
}