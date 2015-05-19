(function(){
	angular.module('angularRecaptcha',['vcRecaptcha'])
	
	.controller('recapCtrl',['vcRecaptchaService','$http',function(vcRecaptchaService,$http){
		var vm = this;
		vm.publicKey = "YOUR ---- SITE -----KEY";
		
		vm.signup = function(){
			
			/* vcRecaptchaService.getResponse() gives you the g-captcha-response */
			
			if(vcRecaptchaService.getResponse() === ""){ //if string is empty
				alert("Please resolve the captcha and submit!")
			}else {
				var post_data = {  //prepare payload for request
					'name':vm.name,
					'email':vm.email,
					'password':vm.password,
					'g-recaptcha-response':vcRecaptchaService.getResponse()  //send g-captcah-reponse to our server
				}
				
				/* Make Ajax request to our server with g-captcha-string */
				$http.post('http://code.ciphertrick.com/demo/phpapi/api/signup',post_data).success(function(response){
					if(response.error === 0){
						alert("Successfully verified and signed up the user");
					}else{
						alert("User verification failed");
					}
				})
				.error(function(error){
				
				})
			}
		}
	}])
})()