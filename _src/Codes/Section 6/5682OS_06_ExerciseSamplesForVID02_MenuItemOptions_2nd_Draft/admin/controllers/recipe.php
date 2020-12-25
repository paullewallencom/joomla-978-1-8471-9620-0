<?php
defined('_JEXEC') or die;

class GoodcookControllerRecipe extends JControllerForm
{
	public function __construct($config = array())
	{
		parent::__construct($config);

	}

	protected function allowEdit($data = array(), $key = 'id')
	{
		return true;
	}

	protected function allowAdd($data = array(), $key = 'id')
	{
		return true;
	}
}
