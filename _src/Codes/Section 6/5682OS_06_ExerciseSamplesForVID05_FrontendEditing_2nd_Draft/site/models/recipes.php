<?php
defined('_JEXEC') or die;
class GoodcookModelRecipes extends JModelList
{
	public function getListQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('a.id,a.title');
		$query->from($db->quoteName('#__goodcook_recipes').' AS a');
		// Join over the categories.
		$query->select('c.title AS category_title');
		$query->join('LEFT', '#__categories AS c ON c.id = a.catid');

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

		$params        = JComponentHelper::getParams('com_goodcook');

		$componentParams        = JComponentHelper::getParams('com_goodcook');
		$menuParams = new JRegistry;

		$app = JFactory::getApplication(); 
		$active = $app->getMenu()->getActive();
		$currentLink = $active->link;
		$menuParams->loadString($active->params);

		if ($active && strpos($currentLink, 'view=recipes')) {
            $componentParams->merge($menuParams);
			$params  = $componentParams;
		}
		else {
			$menuParams->merge($componentParams);
			$params  = $menuParams;
		}

        $recipeOrderby        = $params->get('orderby_sec', 'rdate');
        $recipeOrderDate    = $params->get('order_date', 'publish_up');

        switch($recipeOrderby){
            case 'rdate':
                $query->order('a.' . $recipeOrderDate . ' DESC');
                break;
            case 'date':
                $query->order('a.' . $recipeOrderDate . ' ASC');
                break;
            case 'alpha':
                $query->order('a.title ASC');
                break;
            case 'ralpha':
                $query->order('a.title DESC');
                break;
            case 'author':
                $query->order('a.author ASC');
                break;
            case 'rauthor':
                $query->order('a.author DESC');
                break;
        }

		return $query;
	}
}















