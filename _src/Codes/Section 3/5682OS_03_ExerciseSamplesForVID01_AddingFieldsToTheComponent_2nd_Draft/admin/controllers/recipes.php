<?php
defined('_JEXEC') or die;

class GoodcookControllerRecipes extends JControllerAdmin
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

	public function getModel($name = 'Recipe', $prefix = 'GoodcookModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

}
