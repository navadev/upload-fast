<?php
session_start();
include ('inc/dbconn.php');
include ('inc/func.php');

$ip = $_SERVER['REMOTE_ADDR'];

if (!isset($_SESSION['username'])) {
    $username = $ip;
}
else {
    $username = $_SESSION['username'];
}

$showlinks = null;

if (isset($_POST['formsent']) && $_POST['formsent'] == '1') {
    if (!is_uploaded_file($_FILES['form_upload']['tmp_name'])) {
        $upload_error = "No file was selected. Please try again.";
    }
    else {
        $filename = clean(strtolower($_FILES['form_upload']['name']), $cid);
        $filesize = (int) $_FILES['form_upload']['size'];
        $filetype = exif_imagetype($_FILES['form_upload']['tmp_name']);
        
        $ext = substr($filename, strpos($filename, "."));
        $random = substr(md5($filename), 0, 5) . $ext;

        $img_path = 'images/' . $random;
        $thumb_path =  'thumbs/' . $random;

        $form_private = !empty($_POST['form_private']) ? 1 : 0;

        if ($filetype != IMAGETYPE_GIF && $filetype != IMAGETYPE_JPEG &&
            $filetype != IMAGETYPE_PNG && $filetype != IMAGETYPE_BMP) {
            $upload_error = "That file type is not allowed. Please try again.";
        }
        else if(empty($_POST['form_terms'])) {
            $upload_error = "You must accept the Terms of Agreement to continue.";
        }
        else if ($filesize > 10000000) {
            $upload_error = "Your filesize exceeds the set upload limit.";  
        }
        else{
            move_uploaded_file($_FILES['form_upload']['tmp_name'], $img_path);
                    
            $SQL = "INSERT INTO images (username, originalname, randomname, type, size, private, timeuploaded) VALUES ('$username', '$filename', '$random', '".image_type_to_mime_type($filetype)."', '$filesize', '$form_private', NOW())"; 
            $result = mysqli_query($cid, $SQL);
            if (!$result) {
                echo(mysqli_error($cid));
            }                       

            // Generate Links       
            $showlinks = true;          
            $shared_link = "http://www.upload-fast.com/viewer.php?image=" . $random;
            $direct_link = "http://www.upload-fast.com/images/" . $random;
            $bb_link = "[URL=". $shared_link ."][IMG]". $direct_link ."[/IMG][/URL]";
            $site_link = "&lt;a href=&quot;". $shared_link ."&quot;&gt;&lt;img src=&quot;". $direct_link ."&quot; alt=&quot;Fast Image Upload by Upload-Fast&quot; /&gt;&lt;/a&gt;";        
            
            // Generate Thumbnail
            include_once('inc/thumbnail.inc.php');
            $thumb = new Thumbnail($img_path);
            $thumb->resizePercent(65);
            $thumb->cropFromCenter(140);
            $thumb->save($thumb_path);
            $thumb->destruct();
        }
    }
}


include('header.php');

if (isset($upload_error)) {
    echo "<h5 style=\"color:red;\">". $upload_error ."</h5>";
}
?>      
        <div class="main">
            <form method="post" enctype="multipart/form-data" action="index.php">
                <h5>Use the form below to store images. Limit per upload is <i>10Mb</i>. Please <a href="register.php">register</a> to manage images.</h5>              
                <p><input name="form_upload" type="file" class="input" id="form_upload" size="77" /></p>
                <div class="option_left">Make this image private:</div>
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                <div class="option_right"><input type="checkbox" checked="checked" name="form_private" id="form_private" value="1"/></div>
                <div style="clear:both"></div>
                <div class="option_left">Accept <a href="tos.php">Terms of Agreement</a>:</div>
                <div class="option_right"><input type="checkbox" checked="checked" name="form_terms" id="form_terms" value="1"></div>
                <div style="clear:both"></div>
                <input type="hidden" value="1" name="formsent" />
                <input id="form_submit" name="form_submit" type="image" src="img/upload.png" value="Upload" />              
                <img id="loader" style="display:none; margin:0 auto; padding-top: 5px;" src="img/loader.gif" alt="Please wait your image is being uploaded" border="0" />
                <p>Allowed Types: (.jpeg, .jpg, .png, .gif)</p>
            </form>
            
        <?php
        if ($showlinks == true) {
            echo'
        <div id="result">
            <div style="background:#fff;">
                <h3 class="success">Upload Successful!</h3>
                    <!-- AddThis Button BEGIN -->
                    <script type="text/javascript">var addthis_pub="uploadfast";</script>
                    <a class="bookmark" href="http://www.addthis.com/bookmark.php?v=20" onmouseover="return addthis_open(this, \'\', \'[URL]\', \'[TITLE]\')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/200/addthis_widget.js"></script>
                    <!-- AddThis Button END -->
                <div style="clear:both"></div>
            </div>
            <div class="thumbnail">
                <a href="'. $img_path .'"><img class="thumb_image" src="'. $thumb_path .'" border="0" /></a>
            </div>
            <div id="codes">
                <fieldset>Share Link:</fieldset>
                <input onclick="javascript:this.focus();this.select();" name="text" type="text" value="'. $shared_link .'" size="40" readonly="true" />
                <fieldset>Bulletin Boards:</fieldset>
                <input onclick="javascript:this.focus();this.select();" type="text" value="'. $bb_link .'" size="40" readonly="true" />
                <fieldset>Websites or Myspace:</fieldset>
                <input onclick="javascript:this.focus();this.select();" type="text" value="'. $site_link .'" size="40" readonly="true" />
                <fieldset>Direct Link:</fieldset>
                <input onclick="javascript:this.focus();this.select();" type="text" value="'. $direct_link .'" size="40" readonly="true" />
            </div>
            <div style="clear:both;"></div>
        </div>      
                ';
        }
        else {
        ?>  
            
            <div class="gallery">
            <h3>Recent Uploads:</h3>
                <ul>
                <?php
                    $SQL = "SELECT * FROM images WHERE private <> 1 ORDER BY timeuploaded DESC LIMIT 4";
                    $result = mysqli_query($cid, $SQL);
                    if (!$result) {
                        echo(mysqli_error($cid));
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li class=\"image\"><a href=\"images/".$row['randomname']."\"><img src=\"thumbs/" . $row['randomname'] ."\"></a></li>";
                    }
                ?>
                </ul>   
            </div>
        <?php   
            }
        ?>
        </div>
        
        <p class="footer">&copy; 2007 <a href="http://www.upload-fast.com">Upload-Fast.com</a> - Fast Image Uploads | All Rights Reserved</p>
    </div>
    <b class="rnd_bottom"><b class="rnd_b4"></b><b class="rnd_b3"></b><b class="rnd_b2"></b><b class="rnd_b1"></b></b>
</div>

</body>
</html>
