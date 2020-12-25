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
	
		$date	= JFactory::getDate();
		$user	= JFactory::getUser();
		if (!$this->id) {
			if (!(int) $this->created) {
				$this->created = $date->toSql();
			}
			if (empty($this->created_by)) {
				$this->created_by = $user->get('id');
			}
		}
		// Set publish_up to null date if not set
		if (!$this->publish_up) {
			$this->publish_up = $this->_db->getNullDate();
		}
		// Set publish_down to null date if not set
		if (!$this->publish_down)   {
			$this->publish_down = $this->_db->getNullDate();
		}

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
		
		$this->alias = JApplication::stringURLSafe($this->alias);
		if (empty($this->alias)) {
			$this->alias = JApplication::stringURLSafe($this->title);
		}
		$table = JTable::getInstance('Recipe', 'GoodcookTable');
		if ($table->load(array('alias' => $this->alias, 'catid' => $this->catid)) && ($table->id != $this->id || $this->id == 0))
		{
			$this->setError(JText::_('COM_GOODCOOK_ERROR_UNIQUE_ALIAS'));
			return false;
		}
		if (trim($this->catid) == '') {
			$this->setError(JText::_('COM_CONTACT_WARNING_CATEGORY'));
			return false;
		}
		// remove extra spaces and cr (\r) and lf (\n) characters from string
		if (!empty($this->metakey)) {
			// only process if not empty
			$bad_characters = array("\n", "\r", "\"", "<", ">"); // array of characters to remove
			$after_clean = JString::str_ireplace($bad_characters, "", $this->metakey); // remove bad characters
			$keys = explode(',', $after_clean); // create array using commas as delimiter
			$clean_keys = array();
			foreach($keys as $key) {
				if (trim($key)) {  // ignore blank keywords
					$clean_keys[] = trim($key);
				}
			}
			$this->metakey = implode(", ", $clean_keys); // put array back together delimited by ", "
		}
		// remove quotes and <> brackets
		if (!empty($this->metadesc)) {
			// only process if not empty
			$bad_characters = array("\"", "<", ">");
			$this->metadesc = JString::str_ireplace($bad_characters, "", $this->metadesc);
		}
		
		if ((int) $this->publish_down > 0 && $this->publish_down < $this->publish_up) {
			$this->setError(JText::_('JGLOBAL_START_PUBLISH_AFTER_FINISH'));
			return false;
		}
		return true;
	}
}
