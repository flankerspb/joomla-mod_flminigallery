<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_flminigallery
 *
 * @copyright   Copyright (C) 2017 Vitaliy Moskalyuk. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die;

class ModFlMiniGalleryHelper
{
	const ALLOW = array('png', 'jpg', 'gif');
	
	private static $initComMedia = false;
	private static $imagesPath = null;
	private static $imagesExt = array();
	
	public static function getList(&$params)
	{
		self::initComMedia();
		
		$recursive = $params->get('recursive', '0') === '1';
		$allow = $params->get('allow') ? $params->get('allow') : self::$imagesExt;
		$target = $params->get('folder') ? self::$imagesPath . '/' . $params->get('folder') : self::$imagesPath;
		
		return self::setFiles($target, $allow, $recursive);
	}
	
	private static function setFiles($target, $allow, $recursive)
	{
		$list = array();
		
		$folder = JPATH_SITE . '/' . $target . '/';
		
		$targets = array();
		
		$values = scandir($folder);
		
		sort($values, SORT_NATURAL | SORT_FLAG_CASE);
		
		foreach($values as $value)
		{
			if($value == '.' || $value == '..' )
				continue;
			
			$file = $folder . $value;
			
			if(is_file($file))
			{
				$name = pathinfo($value);
				$ext = strtolower($name['extension']);
				
				foreach($allow as $a)
				{
					if($a == $ext)
					{
						$image = new stdClass();
						$image->src = $target . '/' . $value;
						$image->alt = trim(str_replace('_', ' ', ucfirst($name['filename'])));
						$image->url = '';
						$list[] = $image;
					}
				}
			}
			else if($recursive && is_dir($file))
			{
				$targets[] = $target . '/' . $value;
			}
		}
		
		if($recursive && count($targets))
		{
			foreach($targets as $value)
			{
				$list = array_merge($list, self::setFiles($value, $allow, $recursive));
			}
		}
		
		return $list;
	}
	
	private static function initComMedia()
	{
		if(!self::$initComMedia)
		{
			$com_media_params = JComponentHelper::getParams('com_media');
			self::$initComMedia = true;
			self::$imagesPath = trim($com_media_params->get('image_path'), '/');
			
			$exts = $com_media_params->get('image_extensions', '');
			$exts = str_replace(' ', '', strtolower($imagesExt));
			self::$imagesExt = $exts ? explode(',', $exts) : self::ALLOW;
		}
	}
}
