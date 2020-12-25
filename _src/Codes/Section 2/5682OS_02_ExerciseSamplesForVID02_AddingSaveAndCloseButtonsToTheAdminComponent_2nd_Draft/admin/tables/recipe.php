<?php
defined('_JEXEC') or die;
class GoodcookTableRecipe extends JTable
{
	public function __construct(&$db)
	{
		parent::__construct('#__goodcook_recipes', 'id', $db);
	}
	public function bind($array, $ignore = '')
	{
		return parent::bind($array, $ignore);
	}

	public function store($updateNulls = false)
	{
		// Attempt to store the user data.
		return parent::store($updateNulls);
	}

	public function check()
	{
		// check for valid name
		if (trim($this->title) == '') {
			$this->setError(JText::_('COM_GOODCOOK_ERR_TABLES_TITLE'));
			return false;
		}

		return true;
	}
}
