<?php
include('DB.php');
        
        $getotp = file_get_contents("php://input");
        $otp = json_decode($getotp, TRUE);
		$username = $otp["message"]["from"]["username"];
		$password = rand(1000000000,9999999999);
		$chatid = $otp["message"]["chat"]["id"];
		$message = $otp["message"]["text"];
		
		if (!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
		    
		    DB::query('INSERT INTO users VALUES (\'\', :username, :password, :chatid)', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':chatid'=>$chatid ));
            
            file_get_contents("https://api.telegram.org/[Bot_Token]/sendmessage?chat_id=".$chatid."&text=Registered");
		}
		
		else {
		    file_get_contents("https://api.telegram.org/[Bot_Token]/sendmessage?chat_id=".$chatid."&text=Already registered");
		}
?>
