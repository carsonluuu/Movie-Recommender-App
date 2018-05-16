<?php include './header.php'; ?>


<div class="container mx-auto" style="padding-left: 50px; padding-right: 50px">
<br>
<br>
<div class="jumbotron">
  <div class="container">
    <h2 class="text-center">Add A New Actor/Director</h2>
    <br>
    <hr>
    <form class="form-horizontal" method = "get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group col-sm-2">
            <label for="Type">Type</label>
            <select class="form-control" name="type" >            
                <option value="Actor">Actor</option>
                <option value="Director">Director</option>
            </select>
       </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="First Name">First Name:</label>
        <div class="col-sm-10">
          <input type="First Name" class="form-control" id="firstname" placeholder="Enter First Name" name="firstname" >
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-sm-2" for="Last Name">Last Name:</label>
        <div class="col-sm-10">          
          <input type="Last Name" class="form-control" id="lastname" placeholder="Enter Last Name" name="lastname">
        </div>
      </div>
      
      <div class="form-group col-sm-2">
            <label for="Type">Sex</label>
            <select class="form-control" name="sex">
                <option value="empty"></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
      </div>

     <div class="form-group">
        <label class="control-label col-sm-2" for="Date of Birth">Date of Birth:</label>
        <div class="col-sm-10">
        <input class="form-control" type="date" id="birth" name = "birth">
        </div>
      </div>
      
    <div class="form-group">
      <label for="example-date-input" class="col-2 col-form-label">Date of Die</label>
      <div class="col-10">
        <input class="form-control" type="date" id="die" name = "die">
        <span>(leave blank if alive now)</span>
      </div>
    </div>
      
      <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
    <br>
    <hr>
  </div>

  <div class="container">
    <?php 

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);


    $lastname = $firstname = $type = $sex = $dob = $dod = "";

    $db = new mysqli('localhost', 'cs143', '', 'CS143');

    if($db->connect_errno > 0){
      die('Unable to connect to database [' . $db->connect_error . ']');
    }

    //get values
    $firstname = trim($_GET["firstname"]);
    $lastname  = trim($_GET["lastname"]);
    $type = $_GET["type"]; 
    $sex  = $_GET["sex"];
    $dob  = $_GET["birth"];
    $dod  = (empty($_GET["die"])) ? "empty" : trim($_GET["die"]);

    if ($firstname == "" && $lastname == "" && $dob == "") {
      ;
    } else if ($type == "empty") {
      echo "Type is mandatory input as required";
    } else if ($firstname == "") {
      echo "First Name is mandatory input as required";
    } else if ($lastname == "") {
      echo "Last Name is mandatory input as required";
    } else if ($sex == "empty" && $type == "Actor") {
      echo "Sex is mandatory input as required";
    } else if ($dob == "") {
      echo "Date of Birth is mandatory input as required";
    } else {
          /*--------Update Database----------*/
          //Get number of total rows now
      $query = "SELECT * FROM MaxPersonID";
      $rs    = $db->query($query);
      $row   = $rs->fetch_row();
      $newid = $row[0] + 1;

      if ($type == "Actor") {
        if ($dod == "empty") {
          $query_insert = "INSERT INTO Actor VALUES('$newid', '$lastname', '$firstname', '$sex', '$dob', NULL);";
        } else {
          $query_insert = "INSERT INTO Actor VALUES('$newid', '$lastname', '$firstname', '$sex', '$dob', '$dod');";
        }
      } else if ($type == "Director") {
        if ($dod == "empty") {
          $query_insert = "INSERT INTO Director VALUES('$newid', '$lastname', '$firstname', '$dob', NULL);";
        } else {
          $query_insert = "INSERT INTO Director VALUES('$newid', '$lastname', '$firstname', '$dob', '$dod');";
        }        
      }

      $rs = $db->query($query_insert);

      if ($rs === FALSE) {
        $errmsg = $db->error;
        print "<br>Query failed: $errmsg <br />";
        exit(1);
      }

      // print 'Total rows updated: ' . $db->affected_rows;

      if ($db->affected_rows != -1) {
        $rs = $db->query("UPDATE MaxPersonID SET id = $newid WHERE id = $row[0]");
        echo "New $type has been added! $type id = $newid.";          
        if ($rs === FALSE) {
          $errmsg = $db->error;
          print "<br>Query failed: $errmsg <br />";
          exit(1);
        }
      } 
      // else {
      //   $message = "Failed!!!";
      // }
      $db->close();      
    }


   ?>
  </div> 
</div>
  
</div>
