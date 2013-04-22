<?php

/*
*@ignore
 */
defined('BASEPATH') or exit;

/**
 * a base controller to all application controllers.
 *
 * @version  1.0
 */
class AppController extends CI_Controller
{
	/**
	 * @var  boolean indicator of whther or not iniliaze has been called 
	 */
	private $has_initalized = false;

	
	/**
	 *creates a new instance of AppController
	 *
	 * @access  public
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->initialize();
	}

    /**
     * @var  an associative array which contains the states and province in the United States and Canada
     */
	protected $state_arr = array( 
        "AB" => "Alberta",
        "BC" => "British Columbia",
        "MB" => "Manitoba",
        "NB" => "New Burnswick",
        "NL" => "Newfoundland and Labrador",
        "NS" => "Nova Scotia",
        "NT" => "Northwest Territories",
        "NU" => "Nunavut",
        "ON" => "Ontario",
        "PE" => "Prince Edward Island",
        "QC" => "Quebec",
        "SK" => "Saskatchewan",
        "YT" => "Yukon",
        "divider" => "---------------",
        "AL" => "Alabama",
        "AK" => "Alaska",
        "AZ" => "Arizona",
        "AR" => "Arkansas",
        "CA" => "California",
        "CO" => "Colorado",
        "CT" => "Connecticut",
        "DE" => "Delaware",
        "DC" => "District of Columbia",
        "FL" => "Florida",
        "GA" => "Georgia",
        "HI" => "Hawaii",
        "ID" => "Idaho",
        "IL" => "Illinois",
        "IN" => "Indiana",
        "IA" => "Iowa",
        "KS" => "Kansas",
        "KY" => "Kentucky",
        "LA" => "Louisiana",
        "ME" => "Maine",
        "MD" => "Maryland",
        "MA" => "Massachusetts",
        "MI" => "Michigan",
        "MN" => "Minnesota",
        "MS" => "Mississippi",
        "MO" => "Missouri",
        "MT" => "Montana",
        "NE" => "Nebraska",
        "NV" => "Nevada",
        "NH" => "New Hampshire",
        "NJ" => "New Jersey",
        "NM" => "New Mexico",
        "NY" => "New York",
        "NC" => "North Carolina",
        "ND" => "North Dakota",
        "OH" => "Ohio",
        "OK" => "Oklahoma",
        "OR" => "Oregon",
        "PA" => "Pennsylvania",
        "RI" => "Rhode Island",
        "SC" => "South Carolina",
        "SD" => "South Dakota",
        "TN" => "Tennessee",
        "TX" => "Texas",
        "UT" => "Utah",
        "VT" => "Vermont",
        "VA" => "Virginia",
        "WA" => "Washington",
        "WV" => "West Virginia",
        "WI" => "Wisconsin",
        "WY" => "Wyoming"
    );
    
    /**
     * @var array contains the titles for people
     */
    protected $title = array('Mr.', 'Mrs.', 'Ms.', 'Mrs.', 'Miss', 'Master', 'Dr.', 'Esq.', 'Sir', 'Lord', 'Count', 'Mistress', 'Madam', 'Dame', 'Lady', 'Prof.', 'Capt.', 'Gen.');

    /**
     * @var  an array which will contain the relevant information for file upload configuration settings
     */
    protected $upload_config = array(
            'upload_path' => './uploads',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'max_size' => '100',
            'max_width' => '800',
            'max_height' => '500',
            'max_filename' => '200'
        );

    /**
     * @var string contains the file path of the upload folder, which is used throughout the application to delete profile pictures
     */
    protected $upload_path = '/var/www/final/uploads/';

	/**
	 *handles application initlizaing upon instantiation of the controller
	 * 
	 * @access  protected
	 */
	protected function initialize()
	{	
		//if initalized simple return do now allow init to be called again on the same request
		if ($this->has_initalized) {
			return;
		}

		$this->has_initalized = true;		
	}

	/**
	 *
	 * renders a full page view that includes the header and footer or the main template file with the specified
	 * content view within
	 *
	 * the data array of variables is assign to the available view variable $vars.  therefore, to access the variables 
	 * being passed to the view, you must use $vars['variable_name']  the reason is to reduce the extracted varibes within 
	 * the $this->load->view methods therefore not over populating the local scope with the useless and unneeded symbols
	 *
	 * @access protected
	 * @param  string $view_name the name of the content view
	 * @param array $data an array of variables available with the views
	 */
	final protected function render_view($view_name, array $data = array() ){
		$this->load->view('header', array(
			'vars' => $data
			));
		$this->load->view('template', array(
			'view_filename' => $view_name,
			'vars' => $data
			));
		$this->load->view('footer');
	}

    /**
     * will take the user input and format it properly for the google maps query
     *
     * @access protected
     * @param string $str the user inputted string which will be formatted to query the google maps JSON file
     */
    protected function gmap_prep($str){
        $explode = explode(" ", $str);
        $formatted = implode("+", $explode);
        return $formatted;
    }
}