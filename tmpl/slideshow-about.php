<?php

defined( '_JEXEC' ) or die();

JLoader::register('FlTemplate', JPATH_ROOT . '/templates/2sweb/core/template.php');

FlTemplate::addScript('uikit/slideshow.js', array('version' => 'auto', 'relative' => true));


// 'animation:\'fade|scroll|scale|swipe\'',
// 'duration:500',
// 'height:\'auto\'',
// 'start:0',
// 'autoplay:false|true',
// 'pauseOnHover:true|false',
// 'autoplayInterval:7000',
// 'videoautoplay:true|false',
// 'videomute:true|false',

$data = array(
		'animation:\'scroll\'',
		'autoplay:true',
		'pauseOnHover:false',
		'autoplayInterval:3000',
);

$images = $params->get('images');
$i = 0;
$slidenav = true;
$dotnav = '';

$html = '<div class="uk-panel uk-thumbnail">'
			.'<div class="uk-slidenav-position" data-uk-slideshow="{'.implode(',', $data).'}">'
			.'<ul class="uk-slideshow">';

foreach ($images as $image)
{
	if(file_exists($image->src))
	{
		$alt = $image->alt;
		$attribs = array();
		// $attribs['width'] = '600';
		// $attribs['height'] = '400';
		
		if ($image->title)
		{
			$attribs['title'] = $image->title;
		}
		else
		{
			$attribs['title'] = $image->alt;
		}
		
		if ($isPrefix)
		{
			switch ($addPrefix)
			{
				case 'alt':
					$alt = $prefix . ' ' . $alt;
					break;
				case 'title':
					$attribs['title'] = $prefix . ' ' . $attribs['title'];
					break;
				default:
					break;
			}
		}
		
		$html .= '<li>' . JHtml::image($image->src, $alt, $attribs) . '</li>';
		
		//$dotnav .= '<li data-uk-slideshow-item="'.$i++.'"><a href=""></a></li>';
	}
}

$html .= '</ul>';

if($slidenav)
{
	$html .= '<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>'
				.'<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>';
}

if($dotnav)
{
	$html .= '<ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">'
				.$dotnav
				.'</ul>';
}

$html .= '</div>'
			.'</div>';



echo $html;
