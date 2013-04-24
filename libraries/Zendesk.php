<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Zendesk
{
    protected $_ci;

    function __construct($config = array())
    {
        $this->_ci =& get_instance();
        log_message('debug', 'ZENDESK Class Initialized');
		
		// Load the restclient spark which this is dependant on
		$this->_ci->load->spark('restclient/2.1.0');

		// If a URL was passed to the library
		empty($config) OR $this->initialize($config);
    }

    public function initialize($config)
    {
    	$this->_ci->rest->initialize($config);
	}

	public function search_tickets_by_email($email)
	{
		$ret = $this->_ci->rest->get('search.json',
					array(
						'query' => urldecode('requester:'.$email.'+type:ticket')
				));
		return $ret;
	}
}