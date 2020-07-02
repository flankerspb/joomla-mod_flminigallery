<?php

defined( '_JEXEC' ) or die( );

$showtitle = $module->showtitle;
$module->showtitle = false;
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

switch ($params->get('type')) {
	case 'custom':
		$images = is_object($params->get('images')) ? (array)$params->get('images') : array();
		break;
	default:
		JLoader::register('ModFlMiniGalleryHelper', __DIR__ . '/helper.php');
		$images = ModFlMiniGalleryHelper::getList($params);
		break;
}

if(count($images))
{
	require JModuleHelper::getLayoutPath('mod_flminigallery', $params->get('layout', 'default'));
}
else
{
	echo '<center class="alert">' . JText::_('MOD_FLMINIGALLERY_NO_IMAGES') . '</center>';
}
