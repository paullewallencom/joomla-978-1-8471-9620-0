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
	
		$case_when = ' CASE WHEN ';
		$case_when .= $query->charLength('alias', '!=', '0');
		$case_when .= ' THEN ';
		$a_id = $query->castAsChar('id');
		$case_when .= $query->concatenate(array($a_id, 'alias'), ':');
		$case_when .= ' ELSE ';
		$case_when .= $a_id.' END as slug';
		$query->select($case_when);
		
        $params        = JComponentHelper::getParams('com_goodcook');
        $categoryOrderby    = $params->def('orderby_pri', '');
        switch($categoryOrderby){
            case 'alpha':
                $categoryOrderby = 'title ASC';
                break;
            case 'ralpha':
                $categoryOrderby = 'title DESC';
                break;
            case 'order':
                $categoryOrderby = 'order';
                break;
            default:
                $categoryOrderby = '';
        }
        if (!empty($categoryOrderby)){
            $query->order($categoryOrderby);
        }
       
		

		return $query;
	}

}


















