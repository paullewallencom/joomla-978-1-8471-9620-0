<?php
defined('_JEXEC') or die;
class GoodcookModelCategories extends JModelList
{
	public function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,title');
		$query->from($db->quoteName('#__categories'));
		$query->where('extension = "com_goodcook"');
		$query->where('published = 1');
		$query->where('access = 1');
	
		return $query;
	}
}