<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_flminigallery
 *
 * @copyright   Copyright (C) 2017 Vitaliy Moskalyuk. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('list');

/**
 * Supports a list of allow image exts
 */
class JFormFieldImagesExtensions extends JFormFieldList
{
	/**
	 * The form field type.
	 */
	protected $type = 'ImagesExtensions';
	
	private static $extensions = null;
	
	protected function getOptions()
	{
		if(self::$extensions === null)
		{
			$exts = JComponentHelper::getParams('com_media')->get('image_extensions', '');
			$exts = str_replace(' ', '', strtolower($exts));
			
			self::$extensions = $exts ? explode(',', $exts) : array();
		}
		
		$options = array();
		
		foreach (self::$extensions as $ext)
		{
			$options[] = JHtml::_('select.option', $ext, $ext);
		}
		
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);
		
		return $options;
	}
}
