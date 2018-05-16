<?php include './header.php'; ?>

<div class="container mx-auto" style="padding-left: 50px; padding-right: 50px">
<br>
<br>
<div class="jumbotron">
<?php 
  
  $movieList = $mid = $title = $year = "";
  $directorList = $did = $first = $last = $dob = "";

  $db = new mysqli("localhost", "cs143", "", "CS143");
  if ($db->connect_errno > 0) {
      die('Unable to connect to database [' . $db->connect_error . ']');
  }

  $query_movie = $db->query("SELECT id, title, year FROM Movie ORDER BY id DESC");
  $query_director = $db->query("SELECT id, first, last, dob FROM Director ORDER BY id DESC");

  if (!$query_movie) {
      $errmsg = $db->error;
      print "<br>Query failed: $errmsg <br />";
      exit(1);    
  }

  if (!$query_director) {
      $errmsg = $db->error;
      print "<br>Query failed: $errmsg <br />";
      exit(1);    
  }

  //get infomation of movie list for selection
    while ( ($row1 = $query_movie -> fetch_array()) ){
        $mid    = $row1["id"];
        $title  = $row1["title"];
        $year   = $row1["year"];

        $movieList.="<option value=\"$mid\">".$title." (".$year.")</option>";
    }

  //get infomation of actor list for selection
    while ( ($row2 = $query_director -> fetch_array()) ){
        $did    = $row2["id"];
        $dob    = $row2["dob"];
        $first  = $row2["first"];
        $last   = $row2["last"];

        $directorList.="<option value=\"$did\">".$first." ".$last." (".$dob.")</option>";
    }

 ?>


<div class="container">
  <h2 class="text-center">Add Movie/Director Relationship</h2>
      <br>
    <hr>
  <form class="form-horizontal" method = "get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <div class="form-group col-sm-8">
          <label for="MovieTitle">Movie Title:</label>
          <select class="form-control" name="movie">              
            <option value=NULL> </option>
            <?=$movieList?>
          </select>
    </div>

  <div class="form-group col-sm-8">
          <label for="MovieTitle">Director:</label>
          <select class="form-control" name="director">              
            <option value=NULL> </option>
            <?=$directorList?>   
          </select>
  </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div> 

  </form>
      <br>
    <hr>
</div>


<div class = "container">
  <?php 
  
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);


  $movie = $director = "";

  $movie    = $_GET["movie"];
  $director = $_GET["director"];

  if ($movie == "" && $director == "") {
    ;//escape case for invalid input, here is the default state
  } else if($movie == "") {
    echo "Movie field is mandatory input as required.";
  } else if($director == "") {
    echo "Actor field is mandatory input as required.";
  } else {
      if(!$db->query("INSERT INTO MovieDirector VALUES('$movie','$director')")){
        $errmsg = $db->error;
        print "<br>Query failed: $errmsg <br />";
        exit(1);  
      } else {
        echo "You have add the relationship to the MovieDirector table!";
      }
  }   

  $db->close();

 ?>
</div>

</div>
</div>>

