<?php
function send_registration_email($username, $email) {
    $subject = "Welcome to Upload-Fast.com. Inside are your registration details";
    $message =  "Welcome to Upload-Fast.com. We would like thank you for registering with us. \n Your username is:\n\nUsername: ". $username ."\n\nPlease use it to log in at http://upload-fast.com/member/login.php.\n Please keep this email for your own information.\n
    If you misplace or forget your password you can request a new one using the link above.\n\nThank you,\nUpload-Fast.com Administration";
      
    mail($email, $subject, $message, "From: registration@upload-fast.com");
}


function cleanInput($input) {
    $search = array(
        '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
    );
 
    $output = preg_replace($search, '', $input);
    return $output;
}
  
function clean($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
		include('dbconn.php');
        $output = mysqli_real_escape_string($cid, $input);
    }
    return $output;
}

?>
