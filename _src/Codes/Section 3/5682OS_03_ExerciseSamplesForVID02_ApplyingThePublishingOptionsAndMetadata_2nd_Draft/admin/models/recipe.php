<?php
defined('_JEXEC') or die;
class GoodcookModelRecipe extends JModelAdmin
{
	public function &getItem($pk = null)
	{
		$app = JFactory::getApplication('site'); 
		$id = $app->input->getInt('id');
		if (empty($id)) {
			return $data;
		}
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('a.*');
		$query->from($db->quoteName('#__goodcook_recipes').' AS a');
		// Join over the categories.
		$query->select('c.title AS category_title');
		$query->join('LEFT', '#__categories AS c ON c.id = a.catid');
		$query->where('a.id = '.$id);
		
		$db->setQuery($query);
		$data = $db->loadObject();
	
		return $data;
	}
	public function getForm($data = array(), $loadData = true)
	{
		$app = JFactory::getApplication();
		// Get the form.
		$form = $this->loadForm('com_goodcook.recipe', 'recipe', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_goodcook.edit.recipe.data', array());
		if (empty($data)) {
			$data = $this->getItem();
		}
		return $data;
	}
	public function getTable($type = 'Recipe', $prefix = 'GoodcookTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
}