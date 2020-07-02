<?php

defined( '_JEXEC' ) or die();


JHtml::_('script', 'uikit/slider.js', array('version' => 'auto', 'relative' => true));

$images = $params->get('images');

// $images = (array) $images;
// shuffle($images);
// $images = (object) $images;

$imgAttribs = array();
// $imgAttribs['width'] = "600";
// $imgAttribs['height'] = "400";

$sliderAttribs = array();
$sliderAttribs['center'] = 'center:true';
// $sliderAttribs['threshold'] = 10;
// $sliderAttribs['infinite'] = true;
// $sliderAttribs['activecls'] = 'uk-active';
$sliderAttribs['autoplay'] = 'autoplay:true';
// $sliderAttribs['pauseOnHover'] = 'pauseOnHover:false';
$sliderAttribs['autoplayInterval'] = 'autoplayInterval:5000';


echo '<div class="uk-panel uk-panel-body fl-slider">';

if($params->get('desc'))
{
	echo '<h2 class="uk-text-center uk-margin-large-top uk-margin-large-bottom fl-h uk-h2">' . $params->get('desc') . '</h2>';
}

echo '<div class="uk-slidenav-position fl-shadow" data-uk-slider="{' . implode(',', $sliderAttribs) . '}"><div class="uk-slider-container"><ul class="uk-slider uk-grid-width-1-2 uk-grid-width-small-1-3 uk-grid-width-medium-1-4">';

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
		
		echo '<li>' . JHtml::image($image->src, $alt, $attribs) . '</li>';
	}
}

echo '</ul></div>';
echo '<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a><a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>';
echo '</div></div>';

// echo '<div class="uk-overlay-panel uk-overlay-background"></div>';
// echo '</div>';
