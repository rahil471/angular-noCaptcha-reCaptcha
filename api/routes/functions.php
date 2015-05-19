<?php
function RequiredFields($getvars, $requiredfields,$echoErr = true) {
	if(count($getvars)< count($requiredfields)){
		$error = implode(",",$requiredfields);
    if($echoErr){
      errorMessage(errorCode::$generic_param_missing.$error,errorCode::$generic_param_missing_code);
    }
		//die();
		return 0;
	}
	foreach ($requiredfields as $key) {
		if(array_key_exists($key, $getvars)){
			if (isset($getvars[$key])) {
			}
			else{
				$error = implode(",",$requiredfields);
			}
		}
		else{
			$error = implode(",",$requiredfields);
		}
	}
	if(isset($error) && $echoErr){
		errorMessage(errorCode::$generic_param_missing.$error,errorCode::$generic_param_missing_code);
		//die();
		return 0;
	}
	return 1;
}
	
//error message helper
function errorMessage($message,$errorcode =1) {
	echo json_encode(array(
		'error' => 1,
		'errorCode' => $errorcode,
		'message' => $message
	));
	//die();
}
?>
