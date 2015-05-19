<?php
ini_set('display_errors','on');


$app->post('/signup',function() use($app){
	$req =  $app->request()->getBody(); //get request pramans
	$data = json_decode($req, true); //parse json string
	
	//Should be some validations before you proceed
	//Not in the scope of this tutorial.

	$captcha = $data['g-recaptcha-response']; //Captcha response send by client
        
        //Build post data to make request with fetch_file_contents
        $postdata = http_build_query(
          array(
            'secret' => '-----YOUR SECRET KEY-------', //secret KEy provided by google
            'response' => $captcha,                    // g-captcha-response string sent from client
            'remoteip' => $_SERVER['REMOTE_ADDR']
          )
        );

        //Build options for the post request
        $opts = array('http' =>
          array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
          )
        );

        //Create a stream this is required to make post request with fetch_file_contents
        $context  = stream_context_create($opts); 

	/* Send request to Googles siteVerify API */
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify",false,$context);
	$response = json_decode($response, true);
	

	if($response["success"]===false) { //if user verification failed
		
		/* return error scenario to client */
		echo json_encode(array(
			"error" => 7,
			"message" => "Robots Not allowed (Captcha verification failed)",
			"captchaResult" => $response["success"],
			"captcahErrCodes" => $response["error-codes"]  //error codes sent buy google's siteVerify API
		));
	} else {
	
	         //Should be some Database insertion to sign up the user
	         //before you return the success response
	         //Not in the scope of this tutorial.

		/* return success scenario to client */
		echo json_encode(array(
		"error" => 0,
		"message" => "Successfully signed up!",
			"email" => $data['email'],
			"captchaResult" => $response["success"]
		));
	}

});
?>
