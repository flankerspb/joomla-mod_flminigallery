<?php
defined( '_JEXEC' ) or die;

jimport('joomla.form.formfield');

class JFormFieldHelperFl extends JFormField
{

	protected $type = 'helperfl';

	public function getInput()
	{
		
	}
	public function getOptions()
	{
		// return print_r($this->element);
	}
	public function getLabel()
	{		
		$document = JFactory::getDocument();
		$document->addStyleSheet(JUri::root() . 'modules/mod_flminigallery/assets/css/backend.css');
		$document->addScript(JUri::root() . 'modules/mod_flminigallery/assets/js/backend.js');
		
		$debug = (string)$this->element['debug'];
		
		if ($debug) {
			echo '<pre>';
			print_r($this->element);
			echo '</pre>';
			
			echo '<pre>';
			print_r($this);
			echo '</pre>';
		}
		
		return;
	}
}
