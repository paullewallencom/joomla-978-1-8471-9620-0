<?php
defined('_JEXEC') or die;
class GoodcookController extends JControllerLegacy
{ 
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/goodcook.php';
		// Get the document object.
		$document = JFactory::getDocument();
		
		$id    = $this->input->getInt('id');
		// Set the view based on the Request parameters, 
        // if no view is set default to the "recipes" view
		$vName = $this->input->get('view', 'recipes');
		$this->input->set('view', $vName);
		parent::display($cachable, $safeurlparams);
		
		return $this;
	}
}