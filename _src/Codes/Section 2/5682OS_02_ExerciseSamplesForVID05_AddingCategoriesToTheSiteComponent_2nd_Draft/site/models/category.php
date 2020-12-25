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
	
		return $query;
	}
}