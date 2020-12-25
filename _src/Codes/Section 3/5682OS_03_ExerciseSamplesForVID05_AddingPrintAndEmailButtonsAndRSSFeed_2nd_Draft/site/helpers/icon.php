<?php
defined('_JEXEC') or die;
class JHtmlIcon
{
	public static function email($item, $params, $attribs = array())
	{
		require_once JPATH_SITE . '/components/com_mailto/helpers/mailto.php';
		$uri	= JURI::getInstance();
		$base	= $uri->toString(array('scheme', 'host', 'port'));
		$template = JFactory::getApplication()->getTemplate();
		$link	= $base.JRoute::_('index.php?option=com_goodcook&view=recipe&catid='.$item->catslug.'&id='.$item->slug, false);
		$url	= 'index.php?option=com_mailto&tmpl=component&template='.$template.'&link='.MailToHelper::addLink($link);
		$status = 'width=400,height=350,menubar=yes,resizable=yes';
		$text = '<i class="icon-envelope"></i> ' . JText::_('JGLOBAL_EMAIL');
		$attribs['title']	= JText::_('JGLOBAL_EMAIL');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$output = JHtml::_('link', JRoute::_($url), $text, $attribs);
		return $output;
	}
	public static function print_popup($item, $params = NULL, $attribs = array())
	{
		$uri	= JURI::getInstance();
		$base	= $uri->toString(array('scheme', 'host', 'port'));
		$url  = 'index.php?option=com_goodcook&view=recipe&catid='.$item->catslug.'&id='.$item->slug.'&tmpl=component&print=1&layout=default';
		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';

		$text = '<i class="icon-print"></i> ' . JText::_('JGLOBAL_PRINT');
		$attribs['title']	= JText::_('JGLOBAL_PRINT');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']		= 'nofollow';
		return JHtml::_('link', $base.JRoute::_($url), $text, $attribs);
	}
	public static function print_screen($item, $params, $attribs = array())
	{
		$text = $text = '<i class="icon-print"></i> '.JText::_('JGLOBAL_PRINT');
		return '<a href="#" onclick="window.print();return false;">'.$text.'</a>';
	}
}