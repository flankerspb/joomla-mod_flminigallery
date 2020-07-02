<?php

defined( '_JEXEC' ) or die();

$images = $params->get('images');

$html .='<div class="">'
			.'<table class="uk-table" style="width:auto;">';

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
		
		$icon = '<i class="'. $icon . ' uk-margin-small-right"></i>';
		
		$title_view = '<span class="uk-hidden-small uk-margin-small-right">' . 'Посмотреть' . '</span><span hidden>' . $image->alt . '</span><i class="uk-icon-eye"></i>';
		
		$attribs_view = array();
		$attribs_view['title'] = 'Посмотреть ' . $image->alt;
		$attribs_view['class'] = 'uk-button';
		$attribs_view['target'] = '_blank';
		
		
		$title_download = '<span class="uk-hidden-small uk-margin-small-right">' . 'Скачать' . '</span><span hidden>' . $image->alt . '</span><i class="uk-icon-download"></i>';
		
		$attribs_download = array();
		$attribs_download['title'] = 'Скачать ' . $image->alt;
		$attribs_download['class'] = 'uk-button';
		$attribs_download['download'] = $image->alt;
		
		$html .= '<tr>'
					. '<td>'
					. $icon
					. '<span>' . $image->alt . '</span>'
					. '</td>'
					. '<td class="uk-text-center">'
					. JHtml::link($image->src, $title_view, $attribs_view)
					. '</td>'
					. '<td class="uk-text-center">'
					. JHtml::link($image->src, $title_download, $attribs_download)
					. '</td>'
					. '</tr>';
	}
}

$html .= '</table></div>';

echo $html;
