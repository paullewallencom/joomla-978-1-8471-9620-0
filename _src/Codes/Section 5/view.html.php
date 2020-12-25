<?php
defined('_JEXEC') or die;
class GoodcookViewRecipe extends JViewLegacy 
{
	public function display($tpl = null)
	{
		// Get some data from the models
		$item		= $this->get('Item');
		$this->item      = &$item;

		//determine if this is a print screen
		$app = JFactory::getApplication(); 
		$this->print = $app->input->getBool('print');

		//set meta description
		if ($this->item->metadesc) {
			$this->document->setDescription($this->item->metadesc);
		}
		
		//set metakeywords
		if ($this->item->metakey) {
			$this->document->setMetadata('keywords', $this->item->metakey);
		}

        $dispatcher	= JEventDispatcher::getInstance();

        // Load the parameters.
        $this->params = $app->getParams();
		
        // we are not using offset yet, so force it to 0 - for the content plugin
        $offset = 0;

		$item->introtext = $item->metadesc;
		$item->fulltext = $item->recipe;
		$item->text = $item->fulltext;
		
		// Process the content plugins.
		JPluginHelper::importPlugin('content');
		$results = $dispatcher->trigger('onContentPrepare', array ('com_goodcook.recipe', &$item, &$this->params, $offset));
		
		$item->event = new stdClass;
		$results = $dispatcher->trigger('onContentAfterTitle', array('com_goodcook.recipe', &$item, &$this->params, $offset));
		$item->event->afterDisplayTitle = trim(implode("\n", $results));

        $results = $dispatcher->trigger('onContentBeforeDisplay', array('com_goodcook.recipe', &$item, &$this->params, $offset));
		$item->event->beforeDisplayContent = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onContentAfterDisplay', array('com_goodcook.recipe', &$item, &$this->params, $offset));
		$item->event->afterDisplayContent = trim(implode("\n", $results));

		//pull the text back into recipe field
		$item->recipe = $item->text;


		$title = $this->document->getTitle() . " - " . $this->item->title;
		$this->document->setTitle($title);

		parent::display($tpl);
	}
}