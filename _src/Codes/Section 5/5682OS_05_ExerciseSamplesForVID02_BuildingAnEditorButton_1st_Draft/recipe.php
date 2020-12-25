<?php
defined('_JEXEC') or die;

class plgButtonRecipe extends JPlugin
{
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);

	}

	public function onDisplay($name)
	{ 
 		$js = "
			function goodcookSelectRecipe(id, title, catid) {
			var tag = '{showrecipe ' + id + '}';
			jInsertEditorText(tag, '" . $name . "');
			SqueezeBox.close();
			}";
		
		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration($js);

		JHtml::_('behavior.modal');


		$link = 'index.php?option=com_goodcook&amp;view=recipes&amp;layout=modal&amp;tmpl=component&amp;'.JSession::getFormToken().'=1';

		$button = new JObject;
		$button->modal = true;
		$button->link = $link;
		$button->text = 'Insert Recipe';
		$button->name = 'recipe-add';
		$button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";

		return $button;
	}

}