<?php
	
	class errorCode {
    	//registration error codes
    	public static $user_exists = "This email address is already registered";
    	public static $user_exists_code = "ERROR_1";

			public static $email_not_registered = "This email is not registered";
			public static $email_not_registered_code = "ERROR_11";

    	//generic parameters missing codes
    	public static $generic_param_missing = 'The following fields are required: ';
    	public static $generic_param_missing_code = 'ERROR_MISSING_PARAMS';
			
	}

?>