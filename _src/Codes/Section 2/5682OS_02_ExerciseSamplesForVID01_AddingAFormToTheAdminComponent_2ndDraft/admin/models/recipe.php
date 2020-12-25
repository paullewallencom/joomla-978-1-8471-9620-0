<?php
defined('_JEXEC') or die;

class GoodcookModelRecipe extends JModelAdmin
{
	public function &getItem($pk = null)
	{
		$app = JFactory::getApplication('site'); 
		$id = $app->input->getInt('id');

		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,title,recipe');
		$query->from('#__goodcook_recipes');
		$query->where('id = '.$id);
		
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

}