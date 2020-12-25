<?php
defined('_JEXEC') or die;

// Base this model on the backend version which already has editing methods
require_once JPATH_ADMINISTRATOR.'/components/com_goodcook/models/recipe.php';

class GoodcookModelForm extends GoodcookModelRecipe
{
	public function &getItem($itemId = null)
	{
        $app = JFactory::getApplication('site');
        $id = $app->input->getInt('id');
        // Get a row instance.
        $table = $this->getTable();

        // Attempt to load the row.
        $return = $table->load($id);

        // Check for a table object error.
        if ($return === false && $table->getError())
        {
            $this->setError($table->getError());
            return false;
        }

        $properties = $table->getProperties(1);
        $value = JArrayHelper::toObject($properties, 'JObject');

        // Convert attrib field to Registry.
        $value->params = new JRegistry;
        $value->params->loadString($value->attribs);

        return $value;

    }
}