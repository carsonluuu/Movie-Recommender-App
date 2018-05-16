<?php include './header.php'; ?>
<div class="container mx-auto" style="padding-left: 50px; padding-right: 50px">
<br>
<br>
<div class="jumbotron">
<div class="container">
<?php 
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

  	$db = new mysqli("localhost", "cs143", "", "CS143");
  	if ($db->connect_errno > 0) {
      	die('Unable to connect to database [' . $db->connect_error . ']');
  	}
    $id = $_GET["code"];
    if ($id == "") {
    	;
    } else {
    	$resActor = $db->query("SELECT * FROM Actor WHERE id = $id");
    	$resMovieActor = $db->query("SELECT mid, role FROM MovieActor WHERE aid = $id");
    	if (!$resActor) {
	      	$errmsg = $db->error;
	      	print "<br>Query failed: $errmsg <br />";
	      	exit(1);
	    }
	    if (!$resMovieActor) {
	      	$errmsg = $db->error;
	      	print "<br>Query failed: $errmsg <br />";
	      	exit(1);
	    }
	    $rowActor = $resActor->fetch_array();

?>

	<div class="container">
		<h2 class="text-center">Actor Information Show Page</h2>
		<br>
		<hr>
		<br>
		<div class="container table-responsive mx-auto" style="width: 500px;">
			<h3 class="text-center">Actor Information is:</h3>
			<br>
			<hr>
			<br>
	    <table class="table table-striped table-bordered table-condensed table-hover">
	        <thead class="thead-dark">
	            <tr>
	                <th scope="col">Name</th>
	                <th scope="col">Sex</th>
	                <th scope="col">BirthDay</th>
	                <th scope="col">Day of Death</th>
	            </tr>
	        </thead>
	        <tbody>
	<tr class="table-warning">
	    <td>
	        <?php echo $rowActor["first"].' '.$rowActor["last"]; ?>
	    </td>
	    <td>
	        <?php echo $rowActor["sex"]; ?>
	    </td>
	    <td> 
	        <?php echo $rowActor["dob"]; ?>
	    </td>
	    <td> 
	        <?php 
	        	if ($rowActor["dod"] == "") {
	        		echo "Still Alive";
	        	} else {
	        		echo $rowActor["dod"];
	        	}
	         ?>
	    </td>	    
	</tr>
	      </tbody>
	      </table>
	</div>
	</div>
			
	<div class="container">
		<div class="container table-responsive mx-auto" style="width: 500px;">
		<br>
		<br>
		<h3 class="text-center">Actor's Movies and Role:</h3>
		<br>
		<hr>
		<br>
    	<table class="table table-striped table-bordered table-condensed table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Role</th>
                <th scope="col">Movie Title</th>
            </tr>
        </thead>
        <tbody>
	<?php
	  $index = 1;
	  while ($rowMovieActor = $resMovieActor->fetch_array()) {
	?>
	<tr>
	    <td>
	        <?php 
	        echo "<em>";
	        echo $rowMovieActor["role"];
	        echo "</em>"; 
	        ?>
	    </td>
	    <td>
	        <a href="show_movie.php?code=<?php echo $rowMovieActor["mid"]?>">
	            <?php
	            $row_id_movie = $rowMovieActor["mid"];
	            $row_MovieName = $db->query("SELECT title FROM Movie WHERE id = $row_id_movie");
	            if (!$row_MovieName) {
	      			$errmsg = $db->error;
	      			print "<br>Query failed: $errmsg <br />";
	      			exit(1);
	    		}
	    		$moviee = $row_MovieName->fetch_array(); 
	            echo $moviee["title"]; 
	            ?>
	        </a>
	    </td>
	</tr>
	      <?php } ?> 
	      </tbody>
	      </table>
	</div>

	</div>
<?php
    }
 ?>	
</div>
</div>
</div>

