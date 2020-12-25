<?php
defined('_JEXEC') or die;
$controller	= JControllerLegacy::getInstance('Goodcook');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect(); 