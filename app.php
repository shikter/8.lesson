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

<nav>
<ul STYLE="list-style-image: url(http://www.tlu.ee/~shikter/ristmed2/images/bullet/tlu_bullet.png)">
<form method="get">


<li> 	<label for="who">Name of recipient*: <label><br>
		<input type="text" name="who"><br>
		
<li> 	<label for="message">Message*: <label><br>
		<input type="text" style="width: 173px; height: 45px;" valign="top" name="message"><br>
		
<li> 	<label for="from_who">Your name*: <label><br>
		<input type="text" name="from_who"><br><br>
		
		<input type="submit" value="Send"><br>
</form>		
</ul>
</nav>

<?php

	//require another php file
	// ../../../ means > 3 folders back
	require_once("../../../config.php");
	

	$everything_was_okay = true;

	//********************
	//To field validation
	//********************

	//check if there is variable in the URL
	//if ther is ?to= in the URL
	
	/* 
	Thanks, I added new code function here:
	function generateIdea(){

	}
	*/
	

	if(isset($_GET["who"])){ 
		
		//only if there is message in the URL
		//echo "there is message";
		
		//if its empty
		if(empty ($_GET["who"])){
			//its empty
			$everything_was_okay = false;
			echo "Please enter the name to who you address <br>"; 
			
		}else{
			//its not empty
			echo "To: ".$_GET["who"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as message";
		$everything_was_okay = false;
		
	}	
// -------------------------------------------------------------------
		
	
	
		if(isset($_GET["message"])){
		
		//only if there is message in the URL
		//echo "there is message";
		
		//if its empty
		if(empty ($_GET["message"])){
			//its empty
			$everything_was_okay = false;
			echo "Please enter the message <br>";
			
		}else{
			//its not empty
			echo "The message: ".$_GET["message"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as message";
		$everything_was_okay = false;
	}
	
// -------------------------------------------------------------------

		if(isset($_GET["from_who"])){
		
		//only if there is message in the URL
		//echo "there is message";
		
		//if its empty
		if(empty ($_GET["from_who"])){
			//its empty
		$everything_was_okay = false;
			echo "Please type your name <br>";
			
		}else{
			//its not empty
			echo "From: ".$_GET["from_who"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as message";
		$everything_was_okay = false;
	}
	
// -------------------------------------------------------------------

	//Getting the message from address
	// if there is ?name=... then $_get["name"]
	
	//$my_message = $_GET["message"];
	//$who = $_GET["who"];
	//$from_who = $_GET["from_who"];
	
	
	//echo "Message from ".$from_who. " to ".$who. " - " .$my_message;

	
	/****************************
	*********SAVE TO DB**********
	*****************************/

	// ? was everthing okay
	if($everything_was_okay == true){
		
		echo "Saving to database ...";
		
		//connection with the username and password
		//access username from config
		
		//echo $db_username;
		
		
		
		//1 servername
		//2 username
		//3 password
		//4 database
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_shikter");
		
		$stmt = $mysql->prepare("INSERT INTO messages_sample(recipient, message, sender) VALUES(?,?,?)");
		
		//echo error
		echo $mysql->error;
		
		// we are replacing question marks with values
		// s -string, date or smth that is based on characters and numbers.
		// i - integer, number
		// d - decimal, floatval
		
		// for each question mark its type with one letter
		$stmt->bind_param("sss", $_GET["who"], $_GET["message"], $_GET["from_who"]);
		
		//save
		if($stmt->execute()){
			echo "saved sucessfully";
		}else{
			echo $stmt->error;
		}
		
	}
?>

<p><a href="table.php">Table</a></p>


<?php
	
	
	echo "<p />Today is " .date('l, jS \of F Y - H:i:s');
				   //.date("d.m.Y H:i:s");

?>

<hr />

<?php




			$dataExists = false;
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				$Login_id = $_POST["Login_id"];
				$name = $_POST["name"];
				$date = $_POST["date"];
				$genre = $_POST["genre"];
				$description = $_POST["description"];
					
				if($name && $Login_id && $date && $genre){
					$dataExists = true;
					$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_shikter");
					
					$stmt = $mysql->prepare("INSERT INTO Reservation(Login, Name, reserv_date, label_genre, description) VALUES(?,?,?,?,?)");
					
					//echo error
					echo $mysql->error;
					
					// for each question mark its type with one letter
					$stmt->bind_param("sssss", $_POST["Login_id"], $_POST["name"], $_POST["date"], $_POST["genre"], $_POST["description"]);
					
					//save
					if($stmt->execute()){
						echo "saved sucessfully";
					}else{
						echo $stmt->error;
					}
				}
			}
?>

<html>
		
        <script type="text/javascript">
		
		    function validate(){
			    var Login_id = document.getElementById('Login_id').value;
				var name = document.getElementById('name').value;
				var date = document.getElementById('date').value;
				var genre = document.getElementById('genre').value;
				var error = '';
				var formIsValid = true;
				
				if(!name){
					error += "<br>Name field is required";
					formIsValid = false;
				}
				
				if(!Login_id){
					error += "<br>Login field is required";
					formIsValid = false;
				}
				
				if(!date){
					error += "<br>Please select date";
					formIsValid = false;
				}
				
				/*else{
					if(preg_match("^[0-3][0-9].[0-1][0-9].[0-9]{4}$",$date)){
						//true
					}else{
						formIsValid = false;
					}
				}*/
				
				if(!genre){
					error += "<br>Please select the type of shooting";
					formIsValid = false;
				}
				
				document.getElementById('errors').innerHTML = error;
				return formIsValid;
			}
		</script>		
		
	</head>

    <body> 
        <h3>Make a reservation:</h3>
		
		<?php
		    if($dataExists){
			    echo 
				
				"<div>
				
				<br>Login: $Login_id
				<br>Name: $name
				<br>Date: $date
				<br>Type of shooting: $genre
				<br>Description: $description
				
				</div>
				<br>
				";
		    }
			
		?>
		

		<div id="errors" style="color: red;"></div>
		
		
        <form id="dataForm" method="post" onsubmit="return validate();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
			<table border="0">
				<tr>
					<td width="185">
            <p />Login<span style="color: red;">*</span>: 
					</td>
					
					<td>
			<input type="text" name="Login_id" id="Login_id" style="width: 300px;" placeholder="User name">
					</td>
				</tr>
				
				<tr>
					<td width="185">
			<p />Name<span style="color: red;">*</span>: 
					</td>
					
					<td>
			<input type="text"  name="name" id="name" style="width: 300px;" placeholder="Your full name">
					</td>
				</tr>
				
				<tr>
					<td width="185">
			<p /><span title="Issue date">Issue date<span style="color: red;">*</span>: 
					</td>
					
					<td>
			</span><input type="date" name="date" id="date" style="width: 300px;" placeholder="31.12.2016">
					</td>
				</tr>
				
				<tr>
					<td width="185">
			<p />What kind of movie<span style="color: red;">*</span>: 
					</td>
					
					<td>
			<select id="genre" name="genre" style="width: 300px;" placeholder="Genre">
				<!-- <option value="notselected">Pick a category:</option>  NOT WORKING > without IF and ELSE. -->
				<option></option>
				<option>Clip movie</option>
				<option>Advertisement</option>
				<option>TV production (procedural, broadcasting...)</option>
				<option>Home movie (travel, wedding...)</option>
				<option>Documentary</option>
				<option>Short movie</option>
				<option>Feature film</option>
				<option>Silent film</option>
				<option>Blue movie (+18)</option>
				<option>Animation</option>
				<option>Other</option>
			</select>
					</td>
				</tr>
			
				<tr>
					<td width="185">
			<p />Description: 
					</td>

					<td>
			<textarea name="description" style="width: 300px; height: 120px;"></textarea>
					</td>
				</tr>
				
				<tr>
					<td width="185">
					&nbsp;
					</td>
					
					<td>	
		<br>	<input type="submit" value="Send order">
					</td>
				</tr>
				
			</table>	
        </form>

</section>

<br>

<section id="Terms">
<h2>Description:</h2>
<p> Course: "<strong>Web Programming</strong>".</p>
<p> Teacher: "<strong>Romil Robtsenkov</strong>".</p>
<p>This topic about my learning "<strong><small>PHP</small></strong>" & "<strong><small>MySQL</small></strong>" and also "<strong><small>HTML</small></strong>" & "<strong><small>CSS</small></strong>". </p>
<p>You can see how I develop my skills.
You can find here my first messanger application. Which is on the head of page.
</p>
<center><img src="../../homeworks/1.homework/img/php-mysql-html-css.png" alt="PHP + MySQL & HTML5 + CSS3" width="325";></center>
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