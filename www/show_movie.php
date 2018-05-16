<?php include './header.php'; ?>
<div class="container mx-auto" style="padding-left: 50px; padding-right: 50px">
<br>
<br>
<div class="jumbotron">
<div class="container">
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
    	$queryMovieActor = "SELECT aid, role FROM MovieActor WHERE mid = $id";
    	$queryReview     = "SELECT * FROM Review WHERE mid = $id";
    	$queryMovie      = "SELECT * FROM Movie WHERE id = $id";

    	$res1 = $db->query($queryMovie);
		$res2 = $db->query($queryReview);
		$res3 = $db->query($queryMovieActor);

		if (!$res1) {
    		$errmsg = $db->error;
      		print "<br>Query failed: $errmsg <br />";
      		exit(1);    
  		} else {
  			$row1 = $res1->fetch_array();
?>
		<div class="container">
			<h2 class="text-center">Movie Information List</h2>
			<br>
			<hr>
			<br>
		</div>

		<div class="container">
			<h3 class="text-center">Movie Information</h3>
			<div class="jumbotron text-center">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<tbody>
			  <tr class="table-primary">
			  <td >Movie Title</td>
			  <td > <?php echo $row1["title"].' ('.$row1["year"].')' ?> </td>
			  </tr>
			  <tr class="table-success">
			  <td >Producer</td>
			  <td > <?php echo $row1["company"] ?> </td>
			  </tr>
			  <tr class="table-warning">
			  <td >MPAA Rating</td>
			  <td > <?php echo $row1["rating"] ?> </td>
			  </tr>
			  <tr class="table-info">
			  <td >Director</td>
			  <td >
			  	<?php 			  		 
                    $resDid = $db->query("SELECT did FROM MovieDirector WHERE mid=$id");
     //                if (!$resDid) {
  			// 			$errmsg = $db->error;
  			// 			print "<br>Query failed: $errmsg <br />";
  			// 			exit(1);
					// }                     
                    if (!$resDid) {
                          echo "No Information";
                    }
                    else {
                        $rowDid = $resDid->fetch_array();
                        if ($rowDid) {
                            $rowDirector = $db->query("SELECT first, last, dob FROM Director WHERE id = $rowDid[did]");
                            if (!$rowDirector) {
	      						$errmsg = $db->error;
	      						print "<br>Query failed: $errmsg <br />";
	      						exit(1);
	    					} else {
	                            $row_Director_Name = $rowDirector->fetch_array();
	                            if ($row_Director_Name) {
	                                echo $row_Director_Name['first'].' '.$row_Director_Name['last'].' ('.$row_Director_Name['dob'].')';
	                            } else {
	                            	echo "No Information";
	                            }	    						
	    					}
                        }
                        else {
                            echo "No Information";
                        }
                    }
			  	 ?>
			  </td>
			  </tr>

			  <tr class="table-danger">
			  <td >Genre</td>
			  <td >
			  	<?php 
			  		 $res_Genre = $db->query("SELECT genre FROM MovieGenre WHERE mid = $id");
			  		 if ($res_Genre != False) {
			  		 	$row_Genre = $res_Genre->fetch_array();
			  		 	echo $row_Genre['genre'];
			  		 } else {
			  		 	echo "No Information";
			  		 }
			  	 ?>
			  </td>
			  </tr>			  
			</tbody>
			</table>				
			</div>
		</div>


		<div class="container table-responsive mx-auto" style="width: 500px;">
			<h3 class="text-center">Casting Information</h3>
			<hr>
			<br>
		    <table class="table table-striped table-bordered table-condensed table-hover">
		        <thead class="thead-dark">
		            <tr>
		                <th scope="col">No.</th>
		                <th scope="col">Name</th>
		                <th scope="col">Role</th>
		            </tr>
		        </thead>
		        <tbody>
		<?php
		  $index = 1;
		  while ($row3 = $res3->fetch_array()) {
		?>
		<tr>
		    <td>
		        <?php echo $index; $index = $index + 1; ?>
		    </td>
		    <td>
		        <a href="show_actor.php?code=<?php echo $row3["aid"]?>">
		            <?php
		            	$res_ActorName = $db->query("SELECT first, last FROM Actor WHERE id = $row3[aid]");
		            	if (!$res_ActorName) {
	      					$errmsg = $db->error;
	      					print "<br>Query failed: $errmsg <br />";
	      					exit(1);
	    				} 
	    				$row_Actor_Name = $res_ActorName->fetch_array(); 
		            	echo $row_Actor_Name["first"]."  ".$row_Actor_Name["last"];
		             ?>
		        </a>
		    </td>
		    <td> 
		        <?php
		        echo "<em>";
		        echo $row3["role"];
		        echo "</em>"; 
		        ?>
		    </td>
		</tr>
		      <?php } ?> 
		      </tbody>
		      </table>
		</div>

		<div class="container">
			<hr>
			<br>
			<h3 class="text-center">User Review</h3>
			<br>
			<?php 
                $row_review_num = $db->query("SELECT COUNT(*) as counts FROM Review WHERE mid = $id"); 
                $row_AVG = $db->query("SELECT AVG(rating) as avg FROM Review WHERE mid = $id");
                if ($row_review_num != FALSE && $row_AVG != FALSE) { 
                    $res_counts = $row_review_num->fetch_array()['counts'];
                    $res_avg = number_format($row_AVG->fetch_array()['avg'], 2);

                    if($res_counts > 0) {
                        echo '<div class = "text-center"><b> Average Rating: '.$res_avg.' / 5</b> based on <b>'.$res_counts.'</b> users reviews</div><hr><br>';
                    }
                }
                else {
                    echo 'Average Rating Is Not Available';
                }				

				if ($res2->num_rows < 1) {
					// echo <a href="./comment_movie.php">There is no review!!! Why not be the first to give your comment</a>;
					echo "There is no review!!! Why not be the first to give your comment";
				} else {
			?>
                <ul>
                    <?php while($review = $res2->fetch_array()){ ?>
                     <li>
                        <b><?php echo $review['name'] ?></b> rated <?php echo $review['rating'] ?>/5 at Time:
                        <?php echo $review['time'] ?> 
                        <p><?php echo '<em>"'.$review['comment'].'"</em>'?></p>
                    </li>
                    <?php } ?>
                </ul>
			<?php
				}
			 ?>
			 <br>
			 <hr>
			<a href="./comment_movie.php?code=<?php echo $id?>" class="btn btn-info btn-lg " role="button">Comment It</a>
		
		</div>

<?php
  		}
    }

 ?>

</div>
</div>
</div>


