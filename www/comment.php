<?php include './header.php'; ?>

<div class="container mx-auto" style="padding-left: 50px; padding-right: 50px">
<br>
<br>
<div class="jumbotron">
<?php 
    $movieList = $mid = $title = $year = "";
    $db = new mysqli("localhost", "cs143", "", "CS143");
    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    $query_movie = $db->query("SELECT id, title, year FROM Movie ORDER BY id DESC");
    if (!$query_movie) {
      $errmsg = $db->error;
        print "<br>Query failed: $errmsg <br />";
        exit(1);    
    }
    while ( ($row1 = $query_movie -> fetch_array()) ){
        $mid    = $row1["id"];
        $title  = $row1["title"];
        $year   = $row1["year"];

        $movieList.="<option value=\"$mid\">".$title." (".$year.")</option>";
    }

 ?>

<div class="container">
  <h2 class="text-center">Add Comments</h2>
  <br>
  <hr>
  <br>
  <form class="form-horizontal" method = "get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <div class="form-group col-sm-6">
          <label for="title">Movie Title:</label>
          <select class="form-control" name="title">
            <option value="NULL"> </option>
            <?=$movieList?>
          </select>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2">Your Name:</label>
      <div class="col-sm-4">
        <input type="myname" class="form-control" id="title" placeholder="Enter Your Name" name="myname">
      </div>
    </div>

    <div class="form-group col-sm-2">
          <label for="rating">Ratings:</label>
          <select class="form-control" name="rating">              
            <option value = "NULL">  </option>
            <option value = "1"> 1 </option> 
            <option value = "2"> 2 </option> 
            <option value = "3"> 3 </option> 
            <option value = "4"> 4 </option> 
            <option value = "5"> 5 </option> 
          </select>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2">Comment:</label>
      <div class="col-sm-10">
        <textarea type="comment" class="form-control" placeholder="Enter Comment... no more than 500 characters" name="comment"></textarea>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <br>
        <button type="submit" class="btn btn-warning">RATE</button>
      </div>
    </div> 

  </form>
  <br>
  <hr>
</div>

<div class="container">
  <?php 

  $myname = $title = $rating = $comment = "";
  // $db = new mysqli("localhost", "cs143", "", "CS143");
  // if ($db->connect_errno > 0) {
  //     die('Unable to connect to database [' . $db->connect_error . ']');
  // }
  $title   = ($_GET["title"]);
  $myname  = ($_GET["myname"]);
  $rating  = ($_GET["rating"]);
  $comment = ($_GET["comment"]);

  if ($title == "" && $rating == "" && $comment == "" && $myname == "") {
    ;
  } else if ($title == "NULL") {
    echo "Movie title is mandatory input as required";
  } else if ($rating == "NULL") {
      echo "Movie rating is mandatory input as required";
  } else if ($comment == "") {
      echo "Movie comment is mandatory input as required";
  } else if ($myname == "") {
      echo "Your name is mandatory input as required";    
  }
  else {
    $date = new DateTime();
    $time=date('Y-m-d H:i:s', $date->getTimestamp());

    $query = "";
    if ($myname == "" && $comment != "") {
      $query = "INSERT INTO Review VALUES(NULL, '$time', '$title', '$rating', '$comment')"; 
    } 

    if ($myname != "" && $comment == "") {
      $query = "INSERT INTO Review VALUES('$myname', '$time', '$title', '$rating', NULL)";  
    }

    if ($myname == "" && $comment == "") {
      $query = "INSERT INTO Review VALUES(NULL, '$time', '$title', '$rating', NULL)";       
    }

    if ($myname != "" && $comment != "") {
      $query = "INSERT INTO Review VALUES('$myname', '$time', '$title', '$rating', '$comment')";      
    }

    if (!$db->query($query)) {
          $errmsg = $db->error;
          print "<br>Query failed: $errmsg <br />";
          exit(1);
      } 
      else {
        echo "Many Thanks to Your Comment!!!";
      } 
  

  }

 ?>

</div>

</div>
</div>


