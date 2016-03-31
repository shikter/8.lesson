<a href="app.php">app</a>

<?php

	//table.php

	//getting our config
	require_once("../../../config.php");

	//create connection
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_shikter");
	
	//SQL sentens
	$stmt = $mysql->prepare("SELECT id, recipient, message, sender, created FROM messages_sample ORDER BY created DESC LIMIT 10");
	
	//if error in sentence
	echo $mysql->error;
	
	//variables for data for each row we will get
	$stmt->bind_result($id, $recipient, $message, $sender, $created);

	//query
	$stmt->execute();
	
	$table_html = "";
	
	//add smth to string .=
	$table_html .="<table>";
		$table_html .="<tr>";//start new row
		
			$table_html .="<th>ID</th>";
			$table_html .="<th>Recipient</th>";
			$table_html .="<th>Message</th>";
			$table_html .="<th>Sender</th>";
			$table_html .="<th>Created</th>";
		
		$table_html .="</tr>"; //end row
	
	// GET RESULT
	// we have multiple rows
	while($stmt->fetch()){
			
			
		// DO SOMETHING FOR EACH ROW
		//echo $id." ".$message."<br>";
		$table_html .="<tr>";//start new row
		
			$table_html .="<td>".$id."</td>";	//add colums
			$table_html .="<td>".$recipient."</td>";
			$table_html .="<td>".$message."</td>";
			$table_html .="<td>".$sender."</td>";
			$table_html .="<td>".$created."</td>";
			
		$table_html .="</tr>"; //end row
	}
	
	$table_html .="</table>";
	//echo $table_html;
	
	
//---------------------------------------------------------------------------------------------
echo "<br>";



//SQL sentens
	$stmt2 = $mysql->prepare("SELECT id, Login, Name, reserv_date, label_genre, description, time_created FROM Reservation ORDER BY time_created DESC LIMIT 10");
	
	//if error in sentence
	echo $mysql->error;
	
	//variables for data for each row we will get
	$stmt2->bind_result($id, $Login, $Name, $reserv_date, $label_genre, $description, $time_created);

	//query
	$stmt2->execute();
	
	$table2_html = "";
	
	//add smth to string .=
	$table2_html .="<table>";
	
		$table2_html .="<tr>";//start new row
		
			$table2_html .="<th>ID</th>";
			$table2_html .="<th>Login</th>";
			$table2_html .="<th>Name</th>";
			$table2_html .="<th>The Date when</th>";
			$table2_html .="<th>Type</th>";
			$table2_html .="<th>Description</th>";
			$table2_html .="<th>Time</th>";
		
		$table2_html .="</tr>"; //end row
	
	// GET RESULT
	// we have multiple rows
	while($stmt2->fetch()){
			
			
		// DO SOMETHING FOR EACH ROW
		//echo $id." ".$message."<br>";
		$table2_html .="<tr>";//start new row
		
		
			$table2_html .="<td>".$id."</td>";	//add colums
			$table2_html .="<td>".$Login."</td>";
			$table2_html .="<td>".$Name."</td>";
			$table2_html .="<td>".$reserv_date."</td>";
			$table2_html .="<td>".$label_genre."</td>";
			$table2_html .="<td>".$description."</td>";
			$table2_html .="<td>".$time_created."</td>";
			
		$table2_html .="</tr>"; //end row
	}
	
	$table2_html .="</table>";
	//echo $table2_html;
	
	
	

	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
<style>
   table {
	border:1px solid;
    width: 1000px; 		
	border-collapse: collapse;
    <!-- margin: auto; -->		 
   }
   th { 
    text-align: left; 		 /* Выравнивание по левому краю */
    background: #ccc; 		 /* Цвет фона ячеек */
    padding: 5px; 			 /* Поля вокруг содержимого ячеек */
    border: 1px solid black; /* Граница вокруг ячеек */
   }
   td { 
    padding: 5px; 			 /* Поля вокруг содержимого ячеек */
    border: 1px solid black; /* Граница вокруг ячеек */
	text-align: center; 
 
  </style>
</head>

<body>
	<h1>Table 1</h1>
	<?php echo $table_html; ?>

	<h1>Table 2</h1>
	<?php echo $table2_html; ?>
</body>

</html>

