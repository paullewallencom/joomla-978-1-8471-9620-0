<?php

defined('_JEXEC') or die;

class GoodcookController extends JControllerLegacy
{ 
	public function display($cachable = false, $urlparams = false)
	{
		// Get the document object.
		$document = JFactory::getDocument();

		// Set the default view name from the Request.
		$vName = $this->input->get('view', 'recipes');
		$this->input->set('view', $vName);

		parent::display($cachable, $safeurlparams);

		return $this;
	}
}

