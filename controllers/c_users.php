<?php
class users_controller extends base_controller {

	public function __construct() {
		
		parent::__construct();
		
	}	# End of Method
	
	public function signup() {

		# Set Up view
			$this->template->content 	= View::instance('v_users_signup');
			$this->template->title 		= "Sign Up";

		# No errors yet
			$error = false;

		# Initiate error
			$this->template->content->error = '<br>';
		
		# If not submitted yet 
			if(!$_POST) {
				echo $this->template;
				return;
		
		# If submitted
			} else {
				
				# If the field isn't blank return $_POST value
					foreach($_POST as $field_name => $value) {
						if(!empty($field_name))   {
							$this->template->content-> $field_name = $value;
						}
					}	
			}
		
		# Begin Error Checking of Sign Up form

		# If a field was blank, return error
			foreach($_POST as $field_name => $value) {
				if(empty($value)) {
					$this->template->content->error .= str_replace('_',' ', (ucfirst($field_name))).' was blank.<br>';
					$error = true;
				}
			}	
		
		# Set the maximum limit of the number of characters in fields
        	$limit 	= 50;

		# If a field was more than 25 characters , add a message to the error View variable
			foreach($_POST as $field_name => $value) {
				if(strlen($value) > $limit) {
					$this->template->content->error .= str_replace('_',' ', (ucfirst($field_name))).' was more than 50 characters. Try again!<br>';
					$error = true;
				} 
			}
						
		# Verify email is in correct format, but not blank, send error if bad format
			if (!filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL) && (!empty($_POST["email"]))) {
			  		$this->template->content->error_email = 'Email address not in correct format.<br>';
					$error = true;
			}

		# Sanitize first 
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);

		# Compare form email with database emails 
	        $q = "SELECT users.email
            	FROM users
	            WHERE users.email = '".$_POST['email']."'";
            
        # Return any emails that match form email
        	$matched_email = DB::instance(DB_NAME)->select_row($q);

       	# Email exists in the database return error message
	        if($matched_email) {
	        	$this->template->content->error_email = 'Email address already exists. Try another email address.<br>';
				$error = true;
	        } 

        # End of Error Checking

		# If no errors after submission
			if(!$error) {
				# More data we want stored with the user
					$_POST['created'] 	= Time::now();
					$_POST['modified'] 	= Time::now();
				
				# Note from Marnie in 2016- sha1 is not a very secure hashing algorithm 
				# but was what my assignment required at the time 
				# Salt should be generated using a
				# Cryptographically Secure Pseudo-Random Number Generator (CSPRNG)
				
				# Encrypt the password
					$_POST['password'] 	= sha1(PASSWORD_SALT.$_POST['password']);
				 
				# Encrypt the token
					$_POST['token'] 	= sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

				# Insert this user into the database
					$user_id = DB::instance(DB_NAME)->insert('users',$_POST);

				# Sign up just created the token, now find it to set the cookie to login
				    $q = "SELECT token 
				        FROM users 
				        WHERE email 	= '".$_POST['email']."' 
				        AND password 	= '".$_POST['password']."'";

	   				$token = DB::instance(DB_NAME)->select_field($q);

        		# Set a cookie on the user's browser of the token value in DB
        			setcookie("token", $token, strtotime('+1 year'), '/');

        		# Send them to the My Recipes page as if they manually logged in
        			Router::redirect("/recipes/my_recipes");

			} else {

				# Render template
		    		echo $this->template;
			}

	}	# End of Method
	
	public function login($error=NULL) {	

    	# Setup view
	        $this->template->content = View::instance('v_users_login');
	        $this->template->title   = "Login";
	        $this->template->content->error = $error;

    	# Render template
        	echo $this->template;

	}	# End of Method

	public function p_login() {

		# This processes the login form 

	    # Begin Error Checking of Login Form of blank fields
	 	
	 	# Verify email is in correct format, but not blank, send error if bad format
		 	if(!filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL) && (!empty($_POST["email"]))) {
				  		Router::redirect("/users/login/format");
			}

	    # Checking to see if email field and password field is blank, display error
			if(empty($_POST['email']) && empty($_POST['password'])) {
				Router::redirect("/users/login/both");

	    # If just email was blank, display error
			} elseif(empty($_POST['email'])) {
		        Router::redirect("/users/login/email");

        # If just password was blank, display error
			} elseif(empty($_POST['password'])) {
				Router::redirect("/users/login/pword");
			}

		# End of Error Checking

	    # Hash submitted password so we can compare it against one in the db
	    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

	    # Sanitize first 
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);

	    # Search the db for this email and password
	    # Retrieve the token if it's available
		    $q = "SELECT token 
		        FROM users 
		        WHERE email 	= '".$_POST['email']."' 
		        AND password 	= '".$_POST['password']."'";

	    	$token = DB::instance(DB_NAME)->select_field($q);

	    # If we didn't find a matching token in the database, it means login failed
	    	if(!$token) {

	        # Send them back to the index page with bad login message
	        	Router::redirect("/users/login/error");

	    # But if we did, login succeeded! 
		    } else {
		        # Set a cookie on the user's browser of the token value in DB
		        	setcookie("token", $token, strtotime('+1 year'), '/');

		        # Send them to the My Recipes page
		        	Router::redirect("/recipes/my_recipes");

		    }

	}	# End of Method

	public function logout() {
		
		# Generate and save a new token for next login
    		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

    	# Create a New Token
    		$data = Array("token" => $new_token);

	    # Do the update
	    	DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

	    # Delete their token cookie by setting it to a date in the past - effectively logging them out
	    	setcookie("token", "", strtotime('-1 year'), '/');

	    # Send them back to the main index.
	    	Router::redirect("/");

	}	# End of Method

	public function edit_profile($user_name = NULL) {

		# Make sure User is logged in or redirect to login page
	        if(!$this->user) {
	        	Router::redirect("/users/login");
	        }
        
		# Set Up View
			$this->template->content 				= View::instance('v_users_edit_profile');
			$this->template->title   				= "Profile of ".$this->user->user_name;
		    $this->template->content->user_name 	= $this->user->user_name;
		    $this->template->content->email 		= $this->user->email;

		# No errors yet
			$error = false;

		# Initiate error
			$this->template->content->error 		= '<br>';
		
		# If not submitted yet 
			if(!$_POST) {
				echo $this->template;
				return;
		
		# If submitted
			} else {
				
				# If the field isn't blank return $_POST value
					foreach($_POST as $field_name => $value) {
						if(!empty($field_name)) {
							$this->template->content-> $field_name = $value;
						}
					}	
			}

		# If Cancel button is clicked, Send them to back to My Recipes page 
			if (($_POST['submit']) =='Cancel') {
				Router::redirect("/recipes/my_recipes");
			}

		# Begin Error Checking of Edit Profile form

		# Verify email is in correct format but not blank, send error if bad format
			if (!filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL) && (!empty($_POST['email']))) {
				$this->template->content->error_email = 'Email address not in correct format.<br>';
				$error = true;
			}

        # Set the limit of the number of characters in fields
        	$limit = 50;

        # If a field was more than 25 characters, return error
			foreach($_POST as $field_name => $value) {
				if(strlen($value) > $limit) {
					$this->template->content->error .= str_replace('_',' ', (ucfirst($field_name))).' was more than 50 characters. Try again!<br>';
					$error = true;
				}
			}	

		# If a field was blank, return error
			foreach($_POST as $field_name => $value) {
				if($value == '') {
					$this->template->content->error .= str_replace('_',' ', (ucfirst($field_name))).' was blank.<br>';
					$error = true;
				} 
			}

		# Sanitize first 
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);

		# This compares form email with database emails 
	        $q = "SELECT users.email
	            FROM users
	            WHERE users.email = '".$_POST['email']."'";
	            
        # Find any email address in DB that matches what is in form
        	$matched_email = DB::instance(DB_NAME)->select_row($q);

        # Email exists in the database, but isn't this user's email
	        if($matched_email && (($_POST["email"]) != $this->user->email)) {
	        	$this->template->content->error_email = 'Email address already exists. Try another.<br>';
				$error = true;
	        } 

        # End of Error Checking

        # Encrypt the password
			$_POST['password'] 	= sha1(PASSWORD_SALT.$_POST['password']);
				 
		# Encrypt and reset the token because email may have changed
			$_POST['token'] 	= sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());	

		# If no errors after submission, Update their profile
			if(!$error) {
				$q = "UPDATE users SET 
				    user_name = '".$_POST['user_name']."',  
				    email = '".$_POST['email']."',
				    password = '".$_POST['password']."',
				    token = '".$_POST['token']."'
				    WHERE user_id = " .$this->user->user_id; 

			# Run the command
				DB::instance(DB_NAME)->query($q);

			# We just re-created the token, now find it to set the cookie to login
			    $q = "SELECT token 
			        FROM users 
			        WHERE email 	= '".$_POST['email']."' 
			        AND password 	= '".$_POST['password']."'";

   				$token = DB::instance(DB_NAME)->select_field($q);

    		# Set a cookie on the user's browser of the token value in DB
    			setcookie("token", $token, strtotime('+1 year'), '/');

			# Send them to My recipes with a success message-NEED TO ADD
		    	Router::redirect("/recipes/my_recipes");
		}
			# Render template
	    		echo $this->template;
		
	}	# End of Method

}	# End of the class
