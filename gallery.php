<?php
session_start();
include ('inc/dbconn.php');
require('header.php') ?>

		<div class="main">
			<ul>
		<?php
		$SQL = "SELECT * FROM images WHERE private <> 1 ORDER BY timeuploaded DESC";
		$result = mysqli_query($cid, $SQL);
		if(!$result) { echo (mysqli_error($cid)); }
		else{
			while($row = mysqli_fetch_array($result)){
				echo "<li class=\"image\">";
				echo "<a href=\"images/".$row['randomname']."\"><img src=\"thumbs/".$row['randomname']."\" border=\"0\" ></a>";
				// echo "<h5>Uploaded: ". substr($row['timeuploaded'],0,10) ." </h5>";	
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
