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
		$query->select('a.*');
		$query->from($db->quoteName('#__goodcook_recipes').' AS a');
		$query->where('a.id = '.$id);
		// Join over the categories.
		$query->select('c.title AS category_title');
		$query->join('LEFT', '#__categories AS c ON c.id = a.catid');

		// Get author's name
		$query->select("CASE WHEN a.created_by_alias > ' ' 
						THEN a.created_by_alias 
						ELSE ua.name 
						END AS author");
		$query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');
		
		$db->setQuery($query);
		$data = $db->loadObject();
	
		return $data;
	}
}