<?php include './header.php'; ?>

<div class="container mx-auto" style="padding-left: 50px; padding-right: 50px">
<br>
<br>
<div class="jumbotron">

<h2 class="text-center">Global Search Result</h2>

<?php 

  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

  $search = $_GET["search_all"];
  $db = new mysqli("localhost", "cs143", "", "CS143");
  if ($db->connect_errno > 0) {
      die('Unable to connect to database [' . $db->connect_error . ']');
  }
  if ($search == "") {
    ;
  } else {
    $query = "SELECT id, title, year FROM Movie WHERE title LIKE '%$search%'";

    $res = $db->query($query);
    if (!$res) {
      $errmsg = $db->error;
      print "<br>Query failed: $errmsg <br />";
      exit(1);    
    } else {
?>

<div class="container">
  <br>
  <br>
  <hr>
  <h4 class="text-center">Matching Movies</h4> 
  <br>

</div>

<div class="container table-responsive mx-auto" style="width: 500px;">
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Title</th>
                <th scope="col">Year</th>
            </tr>
        </thead>
        <tbody>
<?php
  $index = 1;
  while ($r = $res->fetch_array()) {
?>
<tr>
    <td>
        <?php echo $index; $index = $index + 1; ?>
    </td>
    <td>
        <a href="show_movie.php?code=<?php echo $r["id"]?>">
            <?php echo $r["title"]; ?>
        </a>
    </td>
    <td> 
        <a href="show_movie.php?code=<?php echo $r["id"]?>">
            <?php echo $r["year"]; ?>
        </a>
    </td>
</tr>
      <?php } ?> 
      </tbody>
      </table>
</div>

<?php 
  } 
  $resActor = $db->query("SELECT id, first, last, sex, dob, dod FROM Actor WHERE first like '%$search%' or last like '%$search%' or CONCAT(first, ' ', last) like '%$search%'");
  if (!$resActor) {
      $errmsg = $db->error;
      print "<br>Query failed: $errmsg <br />";
      exit(1);
  }

?>
  <div class="container">
    <hr>
    <div class="container table-responsive mx-auto" style="width: 700px;">
      <h4 class="text-center">Matching Actors</h4>
      <br>
      <table class="table table-striped table-bordered table-condensed table-hover">
          <thead class="thead-dark">
              <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Name</th>
                  <th scope="col">Sex</th>
                  <th scope="col">BirthDay</th>
                  <th scope="col">Day of Death</th>
              </tr>
          </thead>
          <tbody>
  <?php
  $index = 1;
  while ($rowActor = $resActor->fetch_array()) {
  ?>
  <tr class="table-warning">
      <td>
        <?php echo $index; $index = $index + 1; ?>
      </td>
      <td>
        <a href="show_actor.php?code=<?php echo $rowActor["id"]?>">
            <?php echo $rowActor["first"]."  ".$rowActor["last"]; ?>
        </a>
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


</body>
</html>

