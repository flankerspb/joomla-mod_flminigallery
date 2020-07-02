<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_flminigallery
 *
 * @copyright   Copyright (C) 2017 Vitaliy Moskalyuk. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('folderlist');

/**
 * Supports an HTML select list of site Images folder
 */
class JFormFieldImagesFolderList extends JFormFieldFolderList
{
	/**
	 * The form field type.
	 */
	protected $type = 'ImagesFolderList';
	
	protected $hideNone = true;
	
	protected $recursive = true;
	
	protected static $imagesPath = null;

	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		if(self::$imagesPath === null)
		{
			self::$imagesPath = trim(JComponentHelper::getParams('com_media')->get('image_path'), '/');
		}
		
		$return = parent::setup($element, $value, $group);
		
		if ($return)
		{
			$recursive = (string) $this->element['recursive'];
			$this->recursive = ($recursive != 'false' && $recursive != '0');
			
			$hideNone = (string) $this->element['hide_none'];
			$this->hideNone = ($hideNone != 'false' && $hideNone != '0');
			
			$directory = (string) $this->element['directory'];
			$this->directory = $directory ? self::$imagesPath . '/' . $directory : self::$imagesPath;
		}
		
		return $return;
	}
}
