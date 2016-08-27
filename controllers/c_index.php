<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		
		parent::__construct();

	}	# End of Method
		
	/*-------------------------------------------------------------------------------------------------
	Landing Page
	-------------------------------------------------------------------------------------------------*/
	public function index() {
	        
		# Set Up View
			$this->template->content = View::instance('v_index_index');
			
		# Set the <title> tag
			$this->template->title = APP_NAME . " - Drink the Rainbow for Good Health!" ;
				
		# CSS/JS includes
			/*
			$client_files_head = Array("");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   
	    	*/
	      					     		
		# Render the view
			echo $this->template;

	} # End of method
	

	
} # End of class
