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



		$title = $this->document->getTitle() . " - " . $this->item->title;

		$this->document->setTitle($title);



		parent::display($tpl);

	}

}