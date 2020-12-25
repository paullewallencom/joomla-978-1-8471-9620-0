<?php
defined('_JEXEC') or die;

class GoodcookControllerRecipe extends JControllerForm
{
    // Default model to load, will be class name of GoodcookView{$view_item}
	protected $view_item = 'form';
    // Defaul view when using this controller, will class name GoodcookView{$categories}
	protected $view_list = 'categories';

    // Custom add method to allow redirection to a specific page
	public function add() {
		if (!parent::add()) {
			// Redirect to the return page.
			$this->setRedirect($this->getReturnPage());
		}
	}

	protected function allowEdit($data = array(), $key = 'id') {

        // the default check is for the user to edit any recipe, if it is set
        // then we can return true

        // Since there is no asset tracking, revert to the component permissions.
        if (parent::allowEdit($data, $key)) {
            return true;
        }

        // If the user is not allowed to edit all recipes, they may be allowed
        // to edit their own - so check if they are allowed to edit their own
        // and if this is their document
        $user		= JFactory::getUser();

		if ($user->authorise('core.edit.own',  $this->option)) {
			// If the user can edit his own recipes, is this one of his recipes?
			$ownerId	= (int) isset($data['created_by']) ? $data['created_by'] : 0;
            $recordId	= (int) isset($data[$key]) ? $data[$key] : 0;
            if (empty($ownerId) && $recordId) {
				// Need to do a lookup from the model.
				$record		= $this->getModel()->getItem($recordId);

				if (empty($record)) {
					return false;
				}

				$ownerId = $record->created_by;
			}

			// If the owner is this user, then they may edit
            $userId		= $user->get('id');
            if ($ownerId == $userId) {
				return true;
			}
		}

        // Tests have failed, no edit allowed
        return false;

	}

    // Custom cancel method to allow redirection to a specific page
	public function cancel($key = 'id') {
		parent::cancel($key);

		// Redirect to the return page.
		$this->setRedirect($this->getReturnPage());
	}

    // Custom edit method to define the url variable containing the record id
    public function edit($key = null, $urlVar = 'id') {
		$result = parent::edit($key, $urlVar);
		return $result;
	}

    // Custom getModel method needed so we can define the model name as form instead of the default which would be recipe
    public function getModel($name = 'form', $prefix = '', $config = array('ignore_request' => true)) {
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

    // Custom getRedirectToItemAppend method to redirect finished requests to display the item
	protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id') {

		$tmpl   = $this->input->get('tmpl');
		$append = '';

		// Setup redirect info.
		if ($tmpl) {
			$append .= '&tmpl='.$tmpl;
		}

        // Add the edit layout to force display of edit screen
		$append .= '&layout=edit';

        // For editing records, this is the record id
		if ($recordId) {
			$append .= '&'.$urlVar.'='.$recordId;
		}

        // If using a menu entry, get the menu id and append it
		$itemId	= $this->input->getInt('Itemid');
		if ($itemId) {
			$append .= '&Itemid='.$itemId;
		}

        // If the category id was specified, add it
        $catId  = $this->input->getInt('catid', null, 'get');
		if ($catId) {
			$append .= '&catid='.$catId;
		}

        // If a return page was specified, pass it on
        $return	= $this->getReturnPage();
        if ($return) {
			$append .= '&return='.base64_encode($return);
		}

		return $append;
	}

    // A return url can be used to bring the user back to whatever page they were on after they
    // save or cancel an edit screen
	protected function getReturnPage() {
		$return = $this->input->get('return', null, 'base64');

		if (empty($return) || !JUri::isInternal(base64_decode($return))) {
			return JURI::base();
		}
		else {
			return base64_decode($return);
		}
	}

	// Function that allows child controller access to model data after the data has been saved.
	protected function postSaveHook(JModelLegacy &$model, $validData) {
		$task = $this->getTask();

		if ($task == 'save') {
			$this->setRedirect(JRoute::_('index.php?option=com_goodcook&view=category&id='.$validData['catid'], false));
		}
	}

    // Custom save function in order o set the redirect page upon saving of the record
	public function save($key = null, $urlVar = 'id') {

		$result = parent::save($key, $urlVar);

		// If ok, redirect to the return page.
		if ($result) {
			$this->setRedirect($this->getReturnPage());
		}
		return $result;
	}
}
