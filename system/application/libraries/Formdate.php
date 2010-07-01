<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * FormDate
 * 
 * Lets you create select and option tags for date and time elements.
 * This class relies on the form helper from the Code Igniter framework.
 * 
 * @package		FormDate
 * @version		0.16
 * @author 		Sen Haerens <sen@rotsen.be>
 * @copyright	Copyright (c) 2007, Sen Haerens
 * @link 		http://codeigniter.com/wiki/formdate
 */
class FormDate
{
	/**
	 * Config settings
	 *
	 * - locale: string, lookup your server supported values with `locale -a` shell command
	 * - prefix: string, added to all select name values
	 * - blank:	boolean, display blank option elements for day, month and year
	 *
     * @access	public
	 * @var		array
	 */
	var $config = array
	(
	 	'locale'	=> 'en_US',
		'prefix'	=> '',
		'blank'		=> false
	);
	
	/**
	 * Blank settings
	 *
	 * Set blank option element value and text
	 * 
     * @access	public
	 * @var		array
	 */
	var $blank = array
	(
		null		=> '--'
	);
	
	/**
	 * Year list settings
	 * 
	 * - name: string, value for select name attribute
	 * - start: int, first year in option list	
	 * - end: int, last year in option list
	 * - offset: int, offset from current year
	 * - descend: boolean, descend the option list
	 * - selected: string, option to select
	 * - extra: string, additional attributes for the select element
	 * 
     * @access	public
	 * @var		array
	 */
	var $year = array
	(
		'name'		=> 'year',
		'start'		=> '',	  
		'end'		=> '',	  
		'offset'	=> 3,	  
		'descend'	=> false, 
		'selected' 	=> '',	  
		'extra'		=> ''	  
	);
	
	/**
	 * Month list settings
	 *
	 * - name: string, value for select name attribute
	 * - values: string, numbers = displays month numbers instead of full name, combined = adds number to month name
	 * - descend: boolean, descend the option list
	 * - selected: string, option to select
	 * - extra: string, additional attributes for the select element
	 * 
     * @access	public
	 * @var		array
	 */
	var $month = array
	(                          
		'name'		=> 'month',
		'values'	=> 'names',
		'descend'	=> false,  
		'selected' 	=> '',	   
		'extra'		=> ''	   
	);
	
	/**
	 * Day list settings
	 *
	 * - name: string, value for select name attribute
	 * - descend: boolean, descend the option list
	 * - selected: string, option to select
	 * - extra: string, additional attributes for the select element
	 * 
     * @access	public
	 * @var		array
	 */
	var $day = array
	(                        
		'name'		=> 'day',
		'descend'	=> false,
		'selected' 	=> '',	 
		'extra'		=> ''	  
	);
	
	/**
	 * Hour list settings
	 *
	 * - name: string, value for select name attribute
	 * - format: int, 12 or 24 hour format
	 * - leading: boolean, pad single digits with leading zero
	 * - descend: boolean, descend the option list
	 * - selected: string, option to select
	 * - extra: string, additional attributes for the select element
	 * 
     * @access	public
	 * @var		array
	 */
	var $hour = array
	(                         
		'name'		=> 'hour',
		'format'	=> 12,	  
		'leading'	=> true,  
		'descend'	=> false, 
		'selected' 	=> '',	  
		'extra'		=> ''	  	
	);
	
	/**
	 * Minute list settings
	 *
	 * - name: string, value for select name attribute
	 * - leading: boolean, pad single digits with leading zero
	 * - descend: boolean, descend the option list
	 * - selected: string, option to select
	 * - extra: string, additional attributes for the select element
	 * 
     * @access	public
	 * @var		array
	 */
	var $minute = array
	(                            
		'name'		=> 'minute', 
		'leading'	=> true,	 
		'descend'	=> false,	 
		'selected' 	=> '',		 
		'extra'		=> ''		 
	);
	
	/**
	 * Second list settings
	 *
 	 * - name: string, value for select name attribute
	 * - leading: boolean, pad single digits with leading zero
	 * - descend: boolean, descend the option list
	 * - selected: string, option to select
	 * - extra: string, additional attributes for the select element
	 * 
     * @access	public
	 * @var		array
	 */
	var $second = array         
	(                           
		'name'		=> 'second',
		'leading'	=> true,	
		'descend'	=> false,	
		'selected' 	=> '',		
		'extra'		=> ''		  
	);
	
	/**
	 * Meridian list settings
	 *
	 * - name: string, value for select name attribute
	 * - descend: boolean, descend the option list
	 * - selected: string, option to select
	 * - extra: string, additional attributes for the select element
	 * 
     * @access	public
	 * @var		array
	 */
	var $meridian = array         
	(                             
		'name'		=> 'meridian',
		'descend'	=> false,	  
		'selected' 	=> '',		  
		'extra'		=> ''		    
	);
	
	/**
	 * Code Igniter object instance
	 *
     * @access	private
	 * @var		object
	 */
	var $ci;
	
	/**
	 * Constructor
	 *
     * @access	public
	 * @return	void
	 */
	function formDate()
	{
		// Load ci form helper
		$this->ci =& get_instance();
		$this->ci->load->helper('form');		
	}
	
	/**
	 * Set locale for localized time and date strings
	 *
     * @access	public
	 * @param	string the locale value
	 * @return	void
	 */
	function setLocale($locale = null)
	{
		if (isset($locale) && !empty($locale)):
			
			$this->config['locale'] = $locale;
		
		endif;
		
		setlocale(LC_TIME, $this->config['locale']);
	}
	
	/**
	 * Returns the years in a select element
	 *
     * @access	public
	 * @return	string
	 */
	function selectYear()
	{
		// Variables
		$year = array();
		$year['cur'] = date('Y');
		
		$this->_setSelectedElement($this->year['selected'], $year['cur']);
		
		// Set start/end values
		if (!empty($this->year['start']) && !empty($this->year['end'])):
			
			if ($this->year['start'] < $this->year['end']):
			
				$year['min'] = $this->year['start'];
				$year['max'] = $this->year['end'];
			
			else:

				$year['min'] = $this->year['end'];
				$year['max'] = $this->year['start'];
				$this->year['descend'] = true;
			
			endif;
		
		// Set offset values
		elseif (!empty($this->year['offset']) && $this->year['offset'] != 0):
		
			$year['min'] = $year['cur'] - $this->year['offset'];
			$year['max'] = $year['cur'] + $this->year['offset'];
		
		endif;
		
		// Create options array
		if (isset($year['min']) && isset($year['max'])):
		
			for ($year['cnt'] = $year['min']; $year['cnt'] <= $year['max']; $year['cnt']++):
		
				$this->year['options'][$year['cnt']] = $year['cnt'];
		
			endfor;
			
		endif;
		
		// Return form dropdown
		if (isset($this->year['options'])):

			$this->_descendList($this->year['descend'], $this->year['options']);
			$this->_addBlankElement($this->year['options']);

			return form_dropdown($this->config['prefix'].$this->year['name'], $this->year['options'], $this->year['selected'], $this->year['extra']);
		
		endif;
	}
	
	/**
	 * Returns the months in a select element
	 *
     * @access	public
	 * @return	string
	 */
	function selectMonth()
	{
		// Variables
		$month = array();
		$month['cur'] = strftime('%m');
		$month['min'] = 1;
		$month['max'] = 12;
		
		$this->_setSelectedElement($this->month['selected'], $month['cur']);
	
		// Create options array		
		for ($month['cnt'] = $month['min']; $month['cnt'] <= $month['max']; $month['cnt']++):
		
			switch ($this->month['values']):
			
				case 'numbers':
				$month['value'] = $month['cnt'];
				break;
			
				case 'combined':
				$month['value'] = sprintf('%02d',$month['cnt']).' - '.strftime('%B', mktime(0, 0, 0, $month['cnt'], 1));				
				break;
			
				default:
				$month['value'] = strftime('%B', mktime(0, 0, 0, $month['cnt'], 1));				
				break;
		
			endswitch;
			
			$this->month['options'][sprintf('%02d', $month['cnt'])] = $month['value'];
		
		endfor;
		
		// Return form dropdown
		if (isset($this->month['options'])):

			$this->_descendList($this->month['descend'], $this->month['options']);
			$this->_addBlankElement($this->month['options']);

			return form_dropdown($this->config['prefix'].$this->month['name'], $this->month['options'], $this->month['selected'], $this->month['extra']);
		
		endif;
	}
	
	/**
	 * Returns the days in a select element
	 *
     * @access	public
	 * @return	string
	 */
	function selectDay()
	{
		// Variables
		$day = array();
		$day['cur'] = date('j');
		$day['min'] = 1;
		$day['max'] = 31;
		
		$this->_setSelectedElement($this->day['selected'], $day['cur']);
	
		// Create options array		
		for ($day['cnt'] = $day['min']; $day['cnt'] <= $day['max']; $day['cnt']++):
		
			$this->day['options'][sprintf('%02d', $day['cnt'])] = $day['cnt'];
		
		endfor;
		
		// Return form dropdown
		if (isset($this->day['options'])):

			$this->_descendList($this->day['descend'], $this->day['options']);
			$this->_addBlankElement($this->day['options']);
	
			return form_dropdown($this->config['prefix'].$this->day['name'], $this->day['options'], $this->day['selected'], $this->day['extra']);
		
		endif;		
	}
	
	/**
	 * Returns the hours in a select element
	 *
     * @access	public
	 * @return	string
	 */
	function selectHour()
	{
		// Variables
		$hour = array();
		
		switch ($this->hour['format']):
			
			case 12:
			$hour['cur'] = date('g');
			$hour['min'] = 1;
			$hour['max'] = 12;
			break;
			
			case 24:
			$hour['cur'] = date('G');
			$hour['min'] = 0;
			$hour['max'] = 23;
			break;
		
		endswitch;
				
		$this->_setSelectedElement($this->hour['selected'], $hour['cur']);
		
		// Create options array		
		for ($hour['cnt'] = $hour['min']; $hour['cnt'] <= $hour['max']; $hour['cnt']++):
		
			$this->hour['value'] = sprintf('%02d', $hour['cnt']);
		
			switch ($this->hour['leading']):
		
				case true:
				$this->hour['options'][$this->hour['value']] = $this->hour['value'];
				break;
			
				case false:
				$this->hour['options'][$this->hour['value']] = $hour['cnt'];			
				break;
			
			endswitch;			
		
		endfor;
		
		// Return form dropdown
		if (isset($this->hour['options'])):

			$this->_descendList($this->hour['descend'], $this->hour['options']);		
			$this->_addBlankElement($this->hour['options']);

			return form_dropdown($this->config['prefix'].$this->hour['name'], $this->hour['options'], $this->hour['selected'], $this->hour['extra']);
		
		endif;
	}
	
	/**
	 * Returns the minutes in a select element
	 *
     * @access	public
	 * @return	string
	 */
	function selectMinute()
	{
		// Variables
		$minute = array();
		$minute['cur'] = date('i');
		$minute['min'] = 0;
		$minute['max'] = 59;
		
		$this->_setSelectedElement($this->minute['selected'], $minute['cur']);
	
		// Create options array		
		for ($minute['cnt'] = $minute['min']; $minute['cnt'] <= $minute['max']; $minute['cnt']++):
		
			$this->minute['value'] = sprintf('%02d', $minute['cnt']);
			
			switch ($this->minute['leading']):
			
				case true:
				$this->minute['options'][$this->minute['value']] = $this->minute['value'];
				break;
				
				case false:
				$this->minute['options'][$this->minute['value']] = $minute['cnt'];			
				break;
				
			endswitch;			
		
		endfor;
		
		// Return form dropdown
		if (isset($this->minute['options'])):

			$this->_descendList($this->minute['descend'], $this->minute['options']);	
			$this->_addBlankElement($this->minute['options']);
		
			return form_dropdown($this->config['prefix'].$this->minute['name'], $this->minute['options'], $this->minute['selected'], $this->minute['extra']);
		
		endif;		
	}
	
	/**
	 * Returns the seconds in a select element
	 *
     * @access	public
	 * @return	string
	 */
	function selectSecond()
	{
		// Variables
		$second = array();
		$second['cur'] = date('s');
		$second['min'] = 0;
		$second['max'] = 59;
		
		// Set selected
		$this->_setSelectedElement($this->second['selected'], $second['cur']);
	
		// Create options array		
		for ($second['cnt'] = $second['min']; $second['cnt'] <= $second['max']; $second['cnt']++):
		
			$this->second['value'] = sprintf('%02d', $second['cnt']);
			
			switch ($this->second['leading']):
			
				case true:
				$this->second['options'][$this->second['value']] = $this->second['value'];
				break;
				
				case false:
				$this->second['options'][$this->second['value']] = $second['cnt'];			
				break;
				
			endswitch;			
		
		endfor;
		
		// Return form dropdown
		if (isset($this->second['options'])):

			$this->_descendList($this->second['descend'], $this->second['options']);
			$this->_addBlankElement($this->second['options']);
		
			return form_dropdown($this->config['prefix'].$this->second['name'], $this->second['options'], $this->second['selected'], $this->second['extra']);
		
		endif;		
	}

	/**
	 * Returns AM/PM in a select element
	 *
     * @access	public
	 * @return	string
	 */
	function selectMeridian()
	{
		// Variables
		$meridian = array();
		$meridian['cur'] = date('A');
		$this->meridian['options'] = array('AM' => 'AM', 'PM' => 'PM');
		
		$this->_setSelectedElement($this->meridian['selected'], $meridian['cur']);
		$this->_descendList($this->meridian['descend'], $this->meridian['options']);
		$this->_addBlankElement($this->meridian['options']);
	
		// Return form dropdown
		return form_dropdown($this->config['prefix'].$this->meridian['name'], $this->meridian['options'], $this->meridian['selected'], $this->meridian['extra']);
	}

	/**
	 * Add blank element to the list
	 *
     * @access	private
	 * @param	array the select elements list
	 * @return 	array referenced from argument 1
	 */
	function _addBlankElement(&$array)
	{
		if ($this->config['blank'] && is_array($this->blank)):

			$array = $this->blank + $array;

		endif;
	}

	/**
	 * Set selected list element
	 *
     * @access	private
	 * @param	string the selected element
	 * @param	string the current element
	 * @return	string referenced from argument 1
	 */
	function _setSelectedElement(&$selected, $current = null)
	{
		if ($selected == ''):	
		
			if ($this->config['blank']):
			
				$selected = $this->blank;
			
			else:
		
				$selected = $current;
			
			endif;
			
		endif;
	}
	
	/**
	 * Descend the list
	 *
     * @access	private
	 * @param	boolean if to descend
	 * @param	array the select elements list
	 * @return	array referenced from argument 2
	 */
	function _descendList($descend = false, &$array)
	{
		if ($descend):
			
			$array = array_reverse($array, true);
		
		endif;
	}
}

?>