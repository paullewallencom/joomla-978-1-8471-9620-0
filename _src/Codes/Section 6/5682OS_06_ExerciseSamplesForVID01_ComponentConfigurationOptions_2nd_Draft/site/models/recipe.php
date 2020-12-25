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
		$query->where('a.published = 1');
		// Join over the categories.
		$query->select('c.title AS category_title');
		$query->join('LEFT', '#__categories AS c ON c.id = a.catid');

		// Get author's name
		$query->select("CASE WHEN a.created_by_alias > ' ' 
						THEN a.created_by_alias 
						ELSE ua.name 
						END AS author");
		$query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');
		
		$case_when = ' CASE WHEN ';
		$case_when .= $query->charLength('a.alias', '!=', '0');
		$case_when .= ' THEN ';
		$a_id = $query->castAsChar('a.id');
		$case_when .= $query->concatenate(array($a_id, 'a.alias'), ':');
		$case_when .= ' ELSE ';
		$case_when .= $a_id.' END as slug';
		$query->select($case_when);
		$case_when1 = ' CASE WHEN ';
		$case_when1 .= $query->charLength('c.alias', '!=', '0');
		$case_when1 .= ' THEN ';
		$c_id = $query->castAsChar('c.id');
		$case_when1 .= $query->concatenate(array($c_id, 'c.alias'), ':');
		$case_when1 .= ' ELSE ';
		$case_when1 .= $c_id.' END as catslug';
		$query->select($case_when1);
		
		$db->setQuery($query);
		$data = $db->loadObject();
	
		return $data;
	}
}