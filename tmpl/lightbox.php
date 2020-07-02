<?php
defined( '_JEXEC' ) or die();
// var_dump($params);
 // var_dump($module);

if($showtitle)
{
	$title = $params->get('title');
	$tag = $params->get('header_tag', 'h3');
	$class = $params->get('header_class');
	echo "<{$tag} class='uk-text-center fl-h fl-link {$class}'>{$title}</{$tag}>";
}

$imgAttribs = array();
$urlAttribs = array();

// $imgAttribs['class'] = "";
// $imgAttribs['data-uk-tooltip'] = "{delay:'200',animation:'true'}";

$urlAttribs['target'] = "_blank";


$lightboxAttribs = array();
$lightboxAttribs['class'] = 'uk-overlay-panel uk-overlay-fade uk-overlay-icon uk-overlay-background';
$lightboxAttribs['data-uk-lightbox'] = '{group:\'' . $module->id . '\'}';



$prefix = $params->get('prefix');
$addPrefix = $params->get('add_prefix');
$isPrefix = $params->get('add_prefix') && $prefix;

echo '<div class="uk-panel uk-panel-body"><div class="uk-grid uk-grid-width-1-3  uk-grid-width-small-1-4 uk-grid-width-medium-1-5 fl-minigaggery uk-flex uk-flex-center" data-uk-grid-margin data-uk-grid-match="{target:\'.uk-panel\', row: false}">';

foreach ($images as $image)
{
	if (file_exists($image->src))
	{
		$alt = $image->alt;
		$attribs = $imgAttribs;
		
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
		
		if (pathinfo($image->src, PATHINFO_EXTENSION) == 'svg')
		{
			$width = $params->get('width') ? $params->get('width') . 'px' : '100%';
			
			$svg = simplexml_load_file($image->src);
			$svg->addAttribute('role', 'img');
			$svg->addAttribute('aria-labelledby', 'title');
			$svg->addAttribute('width', $width);
			$svg->addChild('title', $attribs['title'])->addAttribute('id', 'title');
			
			$img = $svg->asXML();
		}
		else
		{
			$img = JHtml::image($image->src, $alt, $attribs);
		}
		
		if ($image->url)
		{
			$html = JHtml::link($image->url, $img, $urlAttribs);
			echo '<div><div class="uk-panel fl-thumbnail">' . $html . '</div></div>';
		}
		else
		{
			// $lightboxAttribs['title'] = $image->alt;
			$url = JHtml::link($image->src, '', $lightboxAttribs);
			echo '<div><div class="uk-panel fl-thumbnail"><div class="uk-overlay uk-overlay-hover">' . $url . $img . '</div></div></div>';
		}
	}
}

echo '</div></div>';
