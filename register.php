<?
session_start();
include ('inc/dbconn.php');
include ('inc/func.php');

//captcha
if (!isset($_SESSION['captchaid']))
    $_SESSION['captchaid'] = rand(0, 5);
  
$questions = array("A white horse is what color?", "35 plus fingers in one hand equals?", "Which is edible? tv, sandwich, computer.", "Hours in a day minus 4 equals?", "How many letters in the word laughter?", "A red pen is what color?");
  
$answers = array('white', 40, 'sandwich', 20, 8, 'red');


if(isset($_POST['register'])) {
    $username = clean($_POST['username']);
    $email = clean($_POST['email']);
    $password = clean($_POST['password']);
    $password_confirm = clean($_POST['password_confirm']);

    if ($username == "" || $password == "" || $password_confirm == "" || $email == "") {
        $error = "One or more fields are blank. All fields are required.";
    } 
    else if($password !== $password_confirm) {
        $error = "Please make sure both passwords match"; 
    }
    else if (!preg_match("/[a-zA-Z0-9.-_+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email)) {
        $error = "Please enter a valid email.";
    }
    else if (isset($_POST['captcha']) && $_POST['captcha'] != $answers[$_SESSION['captchaid']])  {
        $error = "Incorrect answer to the bot question. Please try again.";
    }
    else {
        $SQL = "select * from users where username='$username' OR email='$email'";
        $result = mysqli_query($cid, $SQL);
        if(!$result) { echo (mysqli_error($cid)); }
        else{
            $row = mysqli_fetch_array($result);
        }

        if ($username == $row["username"]) {
            $error = "Sorry, but that username is taken. Please try another one.";
        }
        else if ($email == $row["email"]) {
            $error = "Sorry, but that email is taken. Please try another one.";
        }
        else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $SQL = "INSERT INTO users (username, password, email, ip, time_registered) VALUES ('$username', '$password', '$email', '".$_SERVER['REMOTE_ADDR']."', NOW())";
            $result = mysqli_query($cid, $SQL);
            if(!$result) { echo (mysqli_error($cid)); }										
            //Emails them the password
            send_registration_email($username, $email);
            unset($_SESSION['captchaid']);
            $success = "Thank you! Your registration has been succesfully submitted. An email with your login details has been sent to your email address.";
        }
    }

}

include('header.php');
?>
		<div class="main">
<?php
if (isset($error)){
    echo "<h5 style=\"color:red;\">". $error ."</h5>";
}
if(!isset($success)) {
?>
            <form name="register" method="post" action="register.php">

            <p>
            Username:<br />
            <input name="username" type="text" value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>" id="username" size="30">
            </p>

            <p>
            Email:<br />
            <input name="email" type="text" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" id="email" size="30">
            </p>

            <p>
            Password:<br />
            <input name="password" type="password" size="30">
            </p>

            <p>
            Confirm Password:<br />
            <input name="password_confirm" type="password" size="30" >
            </p>


            <p>
            Anti-bot question: <br /><b> <? echo $questions[$_SESSION['captchaid']]; ?></b><br />
            <input name="captcha" type="text" size="30">
            </p>

            <p>
            <input name="register" type="submit" value="Register">
            </p>

            </form>
<?php
}
else {
    echo "<h5 style=\"color:green;\">". $success."</h5>";
}
?>
	</div>
		<p class="footer">&copy; 2007 <a href="http://www.upload-fast.com">Upload-Fast.com</a> - Fast Image Uploads | All Rights Reserved</p>
	</div>
	<b class="rnd_bottom"><b class="rnd_b4"></b><b class="rnd_b3"></b><b class="rnd_b2"></b><b class="rnd_b1"></b></b>
</div>

</body>
</html>
