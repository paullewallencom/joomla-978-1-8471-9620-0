<?php

defined('_JEXEC') or die('Restricted access');

require_once __DIR__ . '/helper.php';

$data = array();
$data['text'] = htmlspecialchars($params->get('foo_text'));
$data['textarea'] = htmlspecialchars($params->get('foo_textarea'));
$data['texteditor'] = $params->get('foo_editor');
$data['items'] = modFooHelper::getList($params->get('catid'));

require JModuleHelper::getLayoutPath('mod_foo');
