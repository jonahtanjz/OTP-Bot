<?php

include('DB.php');

if (isset($_POST['login'])) {
        $username = $_POST['username'];

        if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
            
            $chatid = DB::query('SELECT chatid FROM users WHERE username=:username', array(':username'=>$username))[0]['chatid'];
            
            $otp = rand(100000,999999);
            
            DB::query('UPDATE users SET password=:password WHERE username=:username', array(':username'=>$username, ':password'=>password_hash($otp, PASSWORD_BCRYPT)));
            
            file_get_contents ("https://api.telegram.org/[Bot_Token]/sendmessage?chat_id=".$chatid."&text=".$otp);
            
            echo '
            <center>
            <form action="otp.php" method="post">
            <input type="text" name="username" value="'.$username.'"><p />
            <input type="text" name="password" value="" placeholder="OTP"><p />
            <input type="submit" name="login" value="Submit">
            </form>
            </center>
        
            ';

        } else {
                echo 'FAKE USER!';
        }

}

else
{
    echo '
        <center>
    <form action="index.php" method="post">
    <input type="text" name="username" value="" placeholder="Username"><p />
    <input type="submit" name="login" value="Get OTP">
    </form>
    </center>
        
    ';
}

?>
