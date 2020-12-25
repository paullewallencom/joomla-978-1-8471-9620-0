<?php
 
defined('JPATH_BASE') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/adapter.php';

class plgFinderGoodcook extends FinderIndexerAdapter
{
	protected $context = 'Goodcook';
	protected $extension = 'com_goodcook';
	protected $layout = 'recipe';
	protected $type_title = 'Goodcook Recipe';
	protected $table = '#__goodcook_recipes';
    protected $state_field = 'published';

	public function __construct(&$subject, $config) {
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	protected function setup() {
		require_once JPATH_SITE . '/components/com_goodcook/helpers/route.php';
		return true;
	}

	protected function getListQuery($sql = null)
	{
		$db = JFactory::getDbo();
		
        // you can pass the query to the function to override the default query;
        // testing for that here
		$sql = $sql instanceof JDatabaseQuery ? $sql : $db->getQuery(true);
		
		$sql->select('a.id, a.catid, a.title, a.alias, a.recipe AS summary,a.recipe AS body');
		$sql->select('a.metakey, a.metadesc');
		$sql->select('1 AS access'); //we don't have ACL on the component yet
		$sql->select('1 AS state'); //we don't have a state column on table
		$sql->select('a.created_by_alias, a.created AS start_date');
		$sql->select('a.publish_up AS publish_start_date, a.publish_down AS publish_end_date');
		$sql->select('c.title AS category, c.published AS cat_state, c.access AS cat_access');

		$case_when_item_alias = ' CASE WHEN ';
		$case_when_item_alias .= $sql->charLength('a.alias', '!=', '0');
		$case_when_item_alias .= ' THEN ';
		$a_id = $sql->castAsChar('a.id');
		$case_when_item_alias .= $sql->concatenate(array($a_id, 'a.alias'), ':');
		$case_when_item_alias .= ' ELSE ';
		$case_when_item_alias .= $a_id.' END as slug';
		$sql->select($case_when_item_alias);

		$case_when_category_alias = ' CASE WHEN ';
		$case_when_category_alias .= $sql->charLength('c.alias', '!=', '0');
		$case_when_category_alias .= ' THEN ';
		$c_id = $sql->castAsChar('c.id');
		$case_when_category_alias .= $sql->concatenate(array($c_id, 'c.alias'), ':');
		$case_when_category_alias .= ' ELSE ';
		$case_when_category_alias .= $c_id.' END as catslug';
		$sql->select($case_when_category_alias);

		$sql->from('#__goodcook_recipes AS a');
		$sql->join('LEFT', '#__categories AS c ON c.id = a.catid');

		return $sql;
	}

	protected function index(FinderIndexerResult $item, $format = 'html') {
		if (JComponentHelper::isEnabled($this->extension) == false) {
			return;
		}

        $item->summary = FinderIndexerHelper::prepareContent($item->summary);
        $item->body = FinderIndexerHelper::prepareContent($item->body);

		$item->url = $this->getURL($item->id, $this->extension, $this->layout);
		$item->route = GoodcookHelperRoute::getRecipeRoute($item->slug, $item->catslug);
		$item->path = FinderIndexerHelper::getContentPath($item->route);

		$item->addInstruction(FinderIndexer::META_CONTEXT, 'link');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metakey');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metadesc');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metaauthor');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'author');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'created_by_alias');

		$item->addTaxonomy('Type', 'Goodcook Recipe');
		$item->addTaxonomy('Category', $item->category, $item->cat_state, $item->cat_access);
		$item->addTaxonomy('Language', $item->language);

        $item->state = $this->translateState($item->state, $item->cat_state);

		FinderIndexerHelper::getContentExtras($item);

		$this->indexer->index($item);
	}

	public function onFinderAfterDelete($context, $table) {
		if ($context == 'com_goodcook.recipe') {
			$id = $table->id;
		}
		elseif ($context == 'com_goodcook.index'){
			$id = $table->link_id;
		}
		else {
			return true;
		}
		return $this->remove($id);
	}

	public function onFinderAfterSave($context, $row, $isNew) {
		if ($context == 'com_goodcook.recipe') {
			$this->reindex($row->id);
		}

		if ($context == 'com_categories.category') {
			if (!$isNew && $this->old_cataccess != $row->access) {
				$this->categoryAccessChange($row);
			}
		}
		return true;
	}

	public function onFinderBeforeSave($context, $row, $isNew) {
		if ($context == 'com_categories.category') {
			if (!$isNew) {
				$this->checkCategoryAccess($row);
			}
		}
		return true;
	}

	public function onFinderChangeState($context, $pks, $value) {
		if ($context == 'com_goodcook.recipe') {
			$this->itemStateChange($pks, $value);
		}
		// when the plugin is disabled
		if ($context == 'com_plugins.plugin' && $value === 0) {
			$this->pluginDisable($pks);
		}
	}

	public function onFinderCategoryChangeState($extension, $pks, $value) {
		if ($extension == 'com_goodcook') {
			$this->categoryStateChange($pks, $value);
		}
	}

}
