<?php
defined('_JEXEC') or die;

JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_goodcook/models', 'GoodcookModel');

class plgContentShowrecipe extends JPlugin
{
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// check if showrecipe tag exists in the content  
		if (strpos($article->text, 'showrecipe') === false) {
				return true;
		}
        // Search for showrecipe tag in the content
        $regex = '/{showrecipe\s+(.*?)}/i';
	 	//each instance of the tag will be sent to the process function and 
		// replaced with the recipe text
        $article->text = preg_replace_callback( $regex, array('self', 'process'), $article->text );
    }

	private function process($match) {
		$ret = '';
		$id = intval($match[1]); //second element of array contains the ID#	
		if ($id) {

		// Get an instance of the recipes model
			$model = JModelLegacy::getInstance('Recipe', 'GoodcookModel', array('ignore_request' => true));
			$item = $model->getItem($id);
			$ret .= '<h3>'.$item->title.'</h3>';
			$ret .= '<div>'.$item->recipe.'</div>';
			$ret = '<div class="recipewrap">'.$ret.'</div>';
		}
		return $ret;
	}

}