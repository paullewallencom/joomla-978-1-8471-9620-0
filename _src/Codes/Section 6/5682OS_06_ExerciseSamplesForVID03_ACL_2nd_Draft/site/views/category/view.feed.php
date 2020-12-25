<?php  
defined('_JEXEC') or die;

class GoodcookViewCategory extends JViewLegacy
{
	public function display($tpl = null)
	{
		$document = JFactory::getDocument();

		$app      = JFactory::getApplication();
		$app->input->set('limit', $app->getCfg('feed_limit'));

		$items    = $this->get('Items');

		foreach ($items as $item)
		{
			$link = JRoute::_('index.php?option=com_goodcook&view=recipe&catid='.$item->catslug.'&id='.$item->slug);

			$title = $this->escape($item->title);
			$title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');

			$date = ($item->publish_up != "0000-00-00 00:00:00" ? date('r', strtotime($item->publish_up)) : date('r', strtotime($item->created)));

			$feeditem = new JFeedItem;
			$feeditem->title       = $title;
			$feeditem->description = $item->metadesc;
			$feeditem->link        = $link;
			$feeditem->date        = $date;
			$feeditem->category    = $item->category_title;
			$feeditem->author      = $item->author;

			$document->addItem($feeditem);

		}
	}
}