<?php

defined( '_JEXEC' ) or die();

JHtml::_('script', 'uikit/slideshow.js', array('version' => 'auto', 'relative' => true));

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
);

$images = $params->get('images');
$i = 0;
$dotnav = '';

$html = ''
			.'<div class="">'
			.'<ul class="uk-list">';

foreach ($images as $image)
{
	if(file_exists($image->src))
	{
		$fileinfo = pathinfo($image->src);
		
		switch(strtolower($fileinfo['extension']))
		{
			case 'pdf':
				$icon = 'uk-icon-file-pdf-o';
				break;
			default:
				$icon = 'uk-icon-file-text-o';
		}
		
		$icon = '<i class="'. $icon .' uk-margin-small-right"></i>';
		
		$title_view = $icon . '<span>' . $image->alt  . '</span>';
		
		$attribs_view = array();
		$attribs_view['title'] = 'Посмотреть ' . $image->alt;
		$attribs_view['class'] = 'uk-button';
		$attribs_view['target'] = '_blank';
		
		
		$title_download = '<i class="uk-icon-download"></i><span hidden>' . $image->alt . '</span>';
		
		$attribs_download = array();
		$attribs_download['title'] = 'Скачать ' . $image->alt;
		$attribs_download['class'] = 'uk-button';
		$attribs_download['download'] = $image->alt;
		
		$html .= '<li class="uk-margin-top">'
					. '<span class="uk-button-group">'
					. JHtml::link($image->src, $title_view, $attribs_view)
					. JHtml::link($image->src, $title_download, $attribs_download)
					. '</span>'
					. '</li>';
	}
}

$html .= '</ul>';

$html .= '</div>';



echo $html;
