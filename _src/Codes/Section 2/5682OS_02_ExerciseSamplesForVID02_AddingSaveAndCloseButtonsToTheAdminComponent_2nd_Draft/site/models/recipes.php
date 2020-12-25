<?php
defined('_JEXEC') or die;

class GoodcookModelRecipes extends JModelList
{
	public function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,title');
		$query->from('#__goodcook_recipes');
	
		return $query;
	}
}