<?php
defined('_JEXEC') or die;
class GoodcookModelCategory extends JModelList
{
	public function getListQuery()
	{
		$app = JFactory::getApplication();
		$id = $app->input->get('id', 0, 'int');
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('a.id,a.title');
		$query->from($db->quoteName('#__goodcook_recipes').' AS a');
		// Join over the categories.
		$query->select('c.title AS category_title');
		$query->join('LEFT', '#__categories AS c ON c.id = a.catid');
        $query->where('a.catid = ' . (int) $id);

		// By start and finish publish dates.
		$nullDate = $db->Quote($db->getNullDate());
		$nowDate = $db->Quote(JFactory::getDate()->toSql());
		$query->where('(a.publish_up = ' . $nullDate . ' OR a.publish_up <= ' . $nowDate . ')');
		$query->where('(a.publish_down = ' . $nullDate . ' OR a.publish_down >= ' . $nowDate . ')');

		// Get author's name
		$query->select("CASE WHEN a.created_by_alias > ' ' 
						THEN a.created_by_alias 
						ELSE ua.name 
						END AS author");
		$query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');
		
	
		return $query;
	}
}