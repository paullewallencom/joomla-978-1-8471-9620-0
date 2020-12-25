<?php
defined('_JEXEC') or die;  

JFormHelper::loadFieldClass('list');

class JFormFieldGoodcookKeywords extends JFormFieldList
{

	public function getLabel() {
		 $label = parent::getLabel() . '<img src="/images/powered_by.png" />';

        $user =& JFactory::getUser();

        $curlabel = (empty($this->element['label']) ? $this->element['name'] : $this->element['label']);
        $newlabel = $user->name."'s ".$curlabel;
        $label = str_replace($curlabel,$newlabel,$label);

		 return $label;
	}

	public function getOptions() {
	
		$options = array();
	
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
	
		$query->select('metakey');
		$query->from('#__goodcook_recipes');
		$query->where('published = 1');
	
		$db->setQuery($query);
		$result = $db->loadObjectList();
	
		$options = array();
		
		//parse the metakeywords and make them into an options array
		foreach ($result as $r) {
			$tmparr = explode(",",$r->metakey);
			foreach ($tmparr as $keyword) {
				$k = JApplication::stringURLSafe($keyword);
				if (!in_array($k,$options)) {
					$options[] = array('value' => $k, 'text' => $k);
				}
			}
		}
		array_unshift($options, JHtml::_('select.option', '', JText::_('JNONE')));

		//return the $options array as used by Joomla to create the dropdown's options
		return $options;
	
	}
	
}




