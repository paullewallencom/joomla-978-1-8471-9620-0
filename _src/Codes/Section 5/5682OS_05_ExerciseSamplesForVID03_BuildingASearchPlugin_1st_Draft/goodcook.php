<?php
defined('_JEXEC') or die;

class plgSearchGoodcook extends JPlugin
{
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	public function onContentSearchAreas()
	{
		static $areas = array(
			'goodcook' => 'Goodcook Recipes'
			); /* this is the title used on the list of search areas */
			return $areas;
	}

	public function onContentSearch($text, $phrase='', $ordering='', $areas=null)
	{
		if (is_array($areas)) {
			if (!array_intersect($areas, array_keys($this->onContentSearchAreas()))) {
				return array();
			}
		}

		$db		= JFactory::getDbo();
		$app	= JFactory::getApplication();

		$section	= 'Goodcook Recipes'; /* this appears under the title in the list of search results */

		$text = trim($text);
		if ($text == '') {
			return array();
		}
		$searchText = $text;

		$limit     = $this->params->def('search_limit', 50);
		$Itemid    = $this->params->def('Itemid');

		$wheres	= array();
		switch ($phrase)
		{
			case 'exact':
				$text		= $db->Quote('%'.$db->escape($text, true).'%', false);
				$wheres2	= array();
				$wheres2[]	= 'a.recipe LIKE '.$text;
				$wheres2[]	= 'a.title LIKE '.$text;
				$where		= '(' . implode(') OR (', $wheres2) . ')';
				break;

			case 'all':
			case 'any':
			default:
				$words	= explode(' ', $text);
				$wheres = array();
				foreach ($words as $word)
				{
					$word		= $db->Quote('%'.$db->escape($word, true).'%', false);
					$wheres2	= array();
					$wheres2[]	= 'a.recipe LIKE '.$word;
					$wheres2[]	= 'a.title LIKE '.$word;
					$wheres[]	= implode(' OR ', $wheres2);
				}
				$where	= '(' . implode(($phrase == 'all' ? ') AND (' : ') OR ('), $wheres) . ')';
				break;
		}

		switch ($ordering)
		{
			case 'oldest':
				$order = 'a.created ASC';
				break;
			case 'alpha':
				$order = 'a.title ASC';
				break;
			case 'category':
				$order = 'c.title ASC, a.title ASC';
				break;
			case 'newest':
			default:
				$order = 'a.created DESC';
		}

		$return = array();
		
		$query	= $db->getQuery(true);
		
		$case_when = ' CASE WHEN ';
		$case_when .= $query->charLength('a.alias', '!=', '0');
		$case_when .= ' THEN ';
		$a_id = $query->castAsChar('a.id');
		$case_when .= $query->concatenate(array($a_id, 'a.alias'), ':');
		$case_when .= ' ELSE ';
		$case_when .= $a_id.' END as slug';

		$case_when1 = ' CASE WHEN ';
		$case_when1 .= $query->charLength('c.alias', '!=', '0');
		$case_when1 .= ' THEN ';
		$c_id = $query->castAsChar('c.id');
		$case_when1 .= $query->concatenate(array($c_id, 'c.alias'), ':');
		$case_when1 .= ' ELSE ';
		$case_when1 .= $c_id.' END as catslug';

		$query->select('a.title AS title, a.recipe AS text, a.created AS created, '
					.$case_when.','.$case_when1.', '
					.$query->concatenate(array($db->Quote($section), "c.title"), " / ").' AS section, \'2\' AS browsernav'); /* '1' will open the link in a new browser window; 2 opens in the same window */
		$query->from('#__goodcook_recipes AS a');
		$query->innerJoin('#__categories AS c ON c.id = a.catid');
		$query->where('('.$where.')' . ' AND a.published = 1 AND  c.published = 1 ');
		$query->order($order);

		// Filter by language
		if ($app->isSite() && $app->getLanguageFilter()) {
			$tag = JFactory::getLanguage()->getTag();
			$query->where('a.language in (' . $db->Quote($tag) . ',' . $db->Quote('*') . ')');
			$query->where('c.language in (' . $db->Quote($tag) . ',' . $db->Quote('*') . ')');
		}

		$db->setQuery($query, 0, $limit);
		$rows = $db->loadObjectList();

		$return = array();
		if ($rows) {
			foreach($rows as $key => $row) {
				$rows[$key]->href = JRoute::_('index.php?option=com_goodcook&view=recipe&catid='.$row->catslug.'&id='.$row->slug.'&Itemid='.$Itemid);
			}

			foreach($rows as $key => $recipe) {
				if (searchHelper::checkNoHTML($recipe, $searchText, array('text', 'title'))) {
					$return[] = $recipe;
				}
			}
		}

		return $return;
	}
}
