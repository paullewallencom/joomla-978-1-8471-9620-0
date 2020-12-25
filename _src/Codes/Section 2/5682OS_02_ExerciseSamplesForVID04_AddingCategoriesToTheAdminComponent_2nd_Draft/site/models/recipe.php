<?php
defined('_JEXEC') or die;

class GoodcookModelRecipe extends JModelItem
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
}