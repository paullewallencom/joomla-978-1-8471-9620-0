<?php
defined('_JEXEC') or die;

class GoodcookControllerRecipe extends JControllerForm
{
	public function __construct($config = array())
	{
		parent::__construct($config);
	}

	public function batch($model = null) {

        // Check the session token to avoid cross site scripting attacks
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Make sure we are using the Recipe model
        $model = $this->getModel('Recipe', '', array());

        // After running the batch process, redirect to the recipe list view
        $this->setRedirect(JRoute::_('index.php?option=com_goodcook&view=recipes' .
									 $this->getRedirectToListAppend(), false));

        // Joomla! provides the rest of the code needed for batch processing
        return parent::batch($model);
    }


}
