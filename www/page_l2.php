<?php include './header.php'; ?>

<div class="container mx-auto" style="padding-left: 50px; padding-right: 50px">
<br>
<br>
<div class="jumbotron">
<div class="container">
  <h2 class="text-center">Add A New Movie</h2>
  <br>
  <hr>
  <form class="form-horizontal" method = "get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <div class="form-group">
      <label class="control-label col-sm-2">Title:</label>
      <div class="col-sm-10">
        <input type="title" class="form-control" id="title" placeholder="Enter Title" name="title" value="<?php echo $_GET['title'];?>">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2">Company:</label>
      <div class="col-sm-10">          
        <input type="company" class="form-control" id="company" placeholder="Enter Company" name="company" value="<?php echo $_GET['company'];?>">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2">Year:</label>
      <div class="col-sm-10">          
        <input type="year" class="form-control" id="year" placeholder="Enter Year" name="year" value="<?php echo $_GET['year'];?>">
      </div>
    </div>

    <div class="form-group col-sm-2">
          <label for="Type">MPAA Rating</label>
          <select class="form-control" name="rating">
              <option value="G">G</option>
              <option value="NC-17">NC-17</option>
              <option value="PG">PG</option>
              <option value="PG-13">PG-13</option>
              <option value="R">R</option>
              <option value="surrendere">surrendere</option>
          </select>

    </div>

    <label class="form-group col-sm-2">Genre:</label>
    <div class = "form-check col-sm-10">
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Action" />
            Action
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Adult" />
            Adult
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Adventure" />
            Adventure
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Animation" />
            Animation
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Comedy" />
            Comedy
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Crime" />
            Crime
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Documentary" />
            Documentary
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Drama" />
            Drama
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Family" />
            Family
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Fantasy" />
            Fantasy
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Horror" />
            Horror
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Musical" />
            Musical
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Mystery" />
            Mystery
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Romantic" />
            Romantic
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Sci-Fi" />
            Sci-Fi
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Short" />
            Short
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Thriller" />
            Thriller
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="War" />
            War
        </label>
        <label class="form-check-label">
            <input type="checkbox" name="genre[]" value="Western" />
            Western
        </label>
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

  $title = $company = $year = $rating = $genre_list = $genre = "";

  $db = new mysqli("localhost", "cs143", "", "CS143");
  if ($db->connect_errno > 0) {
      die('Unable to connect to database [' . $db->connect_error . ']');
  }
  //get the user's input
  $title      = trim($_GET["title"]);
  $company    = trim($_GET["company"]);
  $year       = trim($_GET["year"]);

  $rating     = $_GET["rating"];
  $genre_list = $_GET["genre"];

  //get list value for selected genre
  foreach ($genre_list as $element){
      $genre.=$element." ";
  }

  //Query maxID to determine the new ID

  $rs = $db->query("SELECT * FROM MaxMovieID");
  if (!$rs) {
      print "There is a error happened in Database: cannot fetch Max ID of Movie.";
  }

  $row   = $rs->fetch_row();
  $newid = $row[0] + 1;


  if ($title=="" && $company=="" && $year=="" && $genre_list=="") {
    ;//escape case for invalid input, here is the default state
  } else if($title==""){
      echo "Movie title is mandatory input as required";
  } else if($company==""){
      echo "Company name is mandatory input as required";
  } else if($genre_list==""){
      echo "Genre is mandatory input as required, you need to select at least one type";
  } else {
      //Execute the query
      if (!$db->query("INSERT INTO Movie VALUES('$newid', '$title', '$year', '$rating', '$company')")) {
        $errmsg = $db->error;
        print "<br>Query failed: $errmsg <br />";
        exit(1);
      }

      if (!$db->query("UPDATE MaxMovieID SET id = $newid WHERE id = $row[0]")){
        $errmsg = $db->error;
        print "<br>Query failed: $errmsg <br />";
        exit(1);
      } 
      //Updating for the MovieGenre Table
      if(!$db->query("INSERT INTO MovieGenre VALUES ('$newid', '$genre')")){
        $errmsg = $db->error;
        print "<br>Query failed: $errmsg <br />";
        exit(1);
      }
  //present a success message`
      echo "New Movie <em>$title</em> has been added! Movie ID is $newid.";
  }

  //Close db connection
  $db->close();
?>
</div>
</div>
</div>







