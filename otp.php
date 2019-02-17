<?php

include('DB.php');

if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $otp = rand(1000000000,9999999999);

        if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

                if (password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {
                        echo 'Correct';
                
                DB::query('UPDATE users SET password=:password WHERE username=:username', array(':username'=>$username, ':password'=>password_hash($otp, PASSWORD_BCRYPT)));

                } else {
                        echo 'WRONG!';
                }

        } else {
                echo 'FAKE USER!';
        }

}

?>