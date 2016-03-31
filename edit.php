<?php

	//require another php file
	// ../../../ means > 3 folders back
	require_once("../../../config.php");
	
	//$changed = "";
	
	$notice = "";
	
	
	
	//the variable does not exists in the URL
	if(!isset($_GET["edit"])){
		
		//redirect user
		echo "redirect";
		
		header("Location: table.php");
		exit(); //don't execute further
		
	}else{
		echo "User want to edit row:".$_GET["edit"];
		
		//ask for latest data for single row
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_shikter");
		
		// maybe user wants to update data after clicking the button
		echo $_GET["who"];
		if(isset($_GET["who"]) && isset($_GET["message"]) && isset($_GET["from_who"])){
			
			echo "User modified data, tries to save";
			
			//should be validation
			
			$stmt = $mysql->prepare("UPDATE messages_sample SET recipient=?, message=?, sender=? WHERE id=?");
			
			echo $mysql->error;
			
			$stmt->bind_param("sssi", $_GET["who"], $_GET["message"], $_GET["from_who"], $_GET["edit"]);
			
			if($stmt->execute()){
				
				echo "saved successfully";
				
				//$notice .= "recipient > ".$_GET["who"];
				
				//$notice .= "<br>";
				
				$notice .= "saved successfully";
				
				// option one - redirect:
				
				//header("Location: table.php");
				//exit();
				
				// option two - update variables:
				
				$recipient = $_GET["who"];
				$message = $_GET["message"];
				$sender = $_GET["from_who"];
				$id = $_GET["edit"];
				
				//$changed = "changed ";
				
				
			}else{
				
				echo $stmt->error;
			}
			
			
		}else{
			
					//user did not click any buttons yet,
					//give user latest data from db
					
					$stmt = $mysql->prepare("SELECT id, recipient, message, sender, created FROM messages_sample WHERE id=?");
				
				echo $mysql->error;
				
				//replace the ? mark
				$stmt->bind_param("i", $_GET["edit"]);
				
				//bind result data
				$stmt->bind_result($id, $recipient, $message, $sender, $created);
				
				$stmt->execute();
				//we have only 1 row of data
				if($stmt->fetch()){
					
					//we had data
					echo $id." ".$recipient." ".$message." ".$sender." ".$created;
					
				}else{
					
					//smth went wrong
					echo $stmt->error;
				}
		
			}
		
		
	}
	

?>

<html>

<head>
<!--This is a part not directly visible for users-->
<meta charset="UTF-8"> <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<base target="_self"">
<link rel="stylesheet" type="text/css" href="app.css">
<title>"Web programming - APP"</title>
</head>

<body>
<!-- This is a real visible part of the web page-->
<figure id="tlu_logo"><img border=none src="http://www.tlu.ee/~shikter/ristmed2/images/TLU_logo.jpg" alt="TLU" width="200"></figure>

<section id="application">
<h2><em>Form to send message:</em></h2>

<?php
	if($notice){
		echo "<h3 style='color:green'>".$notice."</h3>";
	}
?>

<nav>
<ul STYLE="list-style-image: url(http://www.tlu.ee/~shikter/ristmed2/images/bullet/tlu_bullet.png)">
<form method="get">

<!--
<li> 	<label for="ID">ID user/sender: <label><br>
-->
		<!--input disabled-->
		<input hidden name="edit" value="<?=$id;?>"><br><br> 

<li> 	<label for="who">Name of recipient*: <label><br>
		<input type="text" name="who" value="<?=$recipient;?>"><br>
		
<li> 	<label for="message">Message*: <label><br>
		<input type="text" style="width: 173px; height: 45px;" valign="top" name="message" value="<?=$message;?>"><br>
		
<li> 	<label for="from_who">Your name*: <label><br>
		<input type="text" name="from_who" value="<?=$sender;?>"><br><br>
		
		<input type="submit" value="Edit"><br>
</form>		
</ul>
</nav>



<p><a href="table.php">Table</a></p>


<?php
	
	
	echo "<p />Today is " .date('l, jS \of F Y - H:i:s');
				   //.date("d.m.Y H:i:s");

?>



</section>

<br>

<hr />

<section id="address">
<br>

<address>Tallinn, Narva Rd 29</address>

<div class="bkt"><a href="http://localhost:5555/~shikter/homeworks/1.homework/" target="_blank">1.Homework - Folder</a></div>

<br>

</section>


</body>
</html>