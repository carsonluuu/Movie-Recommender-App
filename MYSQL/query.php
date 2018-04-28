<html>
<head>
	<title>Project 1B SQL-Queries</title>
</head>

<style>
	body {
		font-family: Arial;
        font-size: 15px;
        width: 50%;
      	border: 3px solid;
      	padding: 30px;
      	margin: auto;;
	}
	form {
	    display: inline-block;
	    text-align: center;
	    padding-left: 130px;
	}
	div	{
		padding-bottom: 30px;
		text-align: center;
	}
</style>
<body>


<div>
	<em>You can type an MySQL query into the textarea below:</em>
	<br><br>
	Example: <tt>SELECT * FROM Actor WHERE id<10;</tt>
</div>

<form action="./query.php" method="GET">
<textarea name="query" cols="50" rows="10">

</textarea>
<br/>
<input type="submit" value="submit" />
</form>


<?php


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


if (isset($_GET["query"])) {
	$db = new mysqli('localhost', 'cs143', '', 'CS143');

	if($db->connect_errno > 0){
    	die('Unable to connect to database [' . $db->connect_error . ']');
	}

	$query = $_GET["query"];
	$rs = $db->query($query);


	if ($rs === FALSE) {
	    $errmsg = $db->error;
	    print "<br>Query failed: $errmsg <br />";
	    exit(1);
	}

	print "<b><h3>Query results are listed in the table below:</h3></b>";

	print "<table border=1 cellspacing=1 cellpadding=2>";
	// $num = $rs->num_rows;

	// echo "$num";  //testing

	print "<tr align=center>";
	//write the schema of table

	$fieldName = mysqli_fetch_fields($rs);

	foreach($fieldName as $element1) {
		print "<td><b> $element1->name </b></td>";
	}

	while (($row = $rs->fetch_row())) {
       print "<tr align=center>";
       foreach($row as $element2){
           print "<td>$element2</td>";
       }
   }

	print "</table>";
	print "</br>";
	// print 'Total rows updated: ' . $db->affected_rows;

	$rs->close();
	$db->close();
}
?>

</body>
</html>