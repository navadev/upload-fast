<?
session_start();
include ('inc/dbconn.php');
include ('inc/func.php');

if (isset($_POST['login'])) {
    $username = clean($_POST['username'], $cid);
    $password = clean($_POST['password'], $cid);

    if ($username == "" || $password == "") {
        $error = "One or more fields were left blank, please try again.";
    } 
    else {
        $SQL = "select * from users where username='$username'";
        $result = mysqli_query($cid, $SQL);
        if (!$result) { 
            $error = "Incorrect login. Please try again.";
        }
        else {
            $row = mysqli_fetch_array($result);
            if (!password_verify($password, $row['password'])) {
                $error = "Incorrect login. Please try again.";
			    $_SESSION["logged"] = 0; 
			    unset($_SESSION["username"]);
            }
            else {
			    $_SESSION["logged"] = 1; 
			    $_SESSION["username"] = $username; 
                header('Location: account.php');
            }
        }
    }
}
include('header.php');
?>
		<div class="main">
<?php
if (isset($error)) {
    echo "<h5 style=\"color:red;\">". $error ."</h5>";
}
?>
        <form name="login" method="post" action="">

        <p>
        Username:<br />
        <input name="username" type="text" id="username" size="30">
        </p>

        <p>
        Password:<br />
        <input name="password" type="password" id="password" size="30">
        </p>

        <p>
        <input name="login" value="Login" type="submit" />
        </p>

        </form>
	</div>
	<p class="footer">&copy; 2007 <a href="http://www.upload-fast.com">Upload-Fast.com</a> - Fast Image Uploads | All Rights Reserved</p>
    </div>
	<b class="rnd_bottom"><b class="rnd_b4"></b><b class="rnd_b3"></b><b class="rnd_b2"></b><b class="rnd_b1"></b></b>
</div>

</body>
</html>
