<?php
session_start();
include ('inc/dbconn.php');
require('header.php');

if (isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "";

if ($action == "logout") {
    $_SESSION["logged"] = 0; 
    unset($_SESSION["username"]);
    header("Location: login.php");
}

?>

        <div class="main">
            <ul>
        <?php
        $SQL = "SELECT * FROM images WHERE username = '" . $_SESSION['username']."'";
        $result = mysqli_query($cid, $SQL);
        if (!$result) {
            echo (mysqli_error($cid));
        }
        else {
            while ($row = mysqli_fetch_array($result)) {
                echo "<li class=\"image\">";
                echo "<a href=\"images/".$row['randomname']."\"><img src=\"thumbs/".$row['randomname']."\" border=\"0\" ></a>";
                echo "</li>";     
            }
        }
        ?>
            </ul>
        </div>
        
        <p class="footer">&copy; 2007 <a href="http://www.upload-fast.com">Upload-Fast.com</a> - Fast Image Uploads | All Rights Reserved</p>
    </div>
    <b class="rnd_bottom"><b class="rnd_b4"></b><b class="rnd_b3"></b><b class="rnd_b2"></b><b class="rnd_b1"></b></b>
</div>

</body>
</html>
