<?php include './header.php'; ?>

<div class="container mx-auto" style="padding-left: 50px; padding-right: 50px">
<br>
<br>
<div class="jumbotron">
<?php 
  
  $movieList = $mid = $title = $year = "";
  $actorList = $aid = $first = $last = $dob = "";

  $db = new mysqli("localhost", "cs143", "", "CS143");
  if ($db->connect_errno > 0) {
      die('Unable to connect to database [' . $db->connect_error . ']');
  }

  $query_movie = $db->query("SELECT id, title, year FROM Movie ORDER BY id DESC");
  $query_actor = $db->query("SELECT id, first, last, dob FROM Actor ORDER BY id DESC");

  if (!$query_movie) {
      $errmsg = $db->error;
      print "<br>Query failed: $errmsg <br />";
      exit(1);    
  }

  if (!$query_actor) {
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
    while ( ($row2 = $query_actor -> fetch_array()) ){
        $aid    = $row2["id"];
        $dob    = $row2["dob"];
        $first  = $row2["first"];
        $last   = $row2["last"];

        $actorList.="<option value=\"$aid\">".$first." ".$last." (".$dob.")</option>";
    }

 ?>


<div class="container">
  <h2 class="text-center">Add Movie/Actor Relationship</h2>
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
          <label for="MovieTitle">Actor:</label>
          <select class="form-control" name="actor">              
            <option value=NULL> </option>
            <?=$actorList?>   
          </select>
  </div>
    
    <div class="form-group">
      <label class="control-label col-sm-8">Role:</label>
      <div class="col-sm-10">          
        <input type="role" class="form-control" id="role" placeholder="Write down the role relationship" name="role" value="<?php echo $_GET['role'];?>">
      </div>
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

<div class="container">
  <?php 
  $role = $movie = $actor = "";
  $role  = $_GET["role"];
  $movie = $_GET["movie"];
    $actor = $_GET["actor"];

    if ($movie == "" && $actor == "" && $role == "") {
      ;//escape case for invalid input, here is the default state
    } else if($movie == "") {
      echo "Movie field is mandatory input as required.";
    } else if($actor == "") {
      echo "Actor field is mandatory input as required.";
    } else if($role == ""){
      echo "Role is mandatory input as required.";
    } else {
        if(!$db->query("INSERT INTO MovieActor VALUES('$movie','$actor','$role')")){
        $errmsg = $db->error;
        print "<br>Query failed: $errmsg <br />";
        exit(1);  
        } else {
      echo "You have add the relationship to the MovieActor table!";
        }
    }   

 ?> 
</div>


</div>
</div>

