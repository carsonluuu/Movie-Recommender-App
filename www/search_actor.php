<?php include './header.php'; ?>

<div class="container mx-auto" style="padding-left: 50px; padding-right: 50px">
<br>
<br>
<div class="jumbotron">
    <div>
      <h1 class="text-center">Search for Actors/Actress!</h1>
      <br>
      <hr>
      <br>
      <br>
        <form class="form-inline" method = "GET" action="./search_actor.php">
        <div class="input-group col-lg-6 w-50 mx-auto">
            <div class="input-group-prepend">
            <a class="btn btn-outline-secondary" type="button" href="./index.php" role = "button">GO BACK</a>
            </div>
            <input type="text" class="form-control col-lg-9" name="search_actor" aria-label="Text input with dropdown button" value="<?php echo $_GET['search_actor'];?>">
            <input type="submit" value="GO!" class="btn btn-primary search-box">
        </div>
        </form>
      </div>

<?php 

  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

  $actor = $_GET["search_actor"];
  $db = new mysqli("localhost", "cs143", "", "CS143");
  if ($db->connect_errno > 0) {
      die('Unable to connect to database [' . $db->connect_error . ']');
  }
  if ($actor == "") {
    ;
  } else {

    $query = "SELECT id, first, last, dob FROM Actor WHERE last like '%$actor%' or first like '%$actor%' or CONCAT(first, ' ', last) like '%$actor%'";

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
  <h4 class="text-center">Related Actor/Actoress are listed in table below:</h4> 
  <br>

</div>

<div class="container table-responsive mx-auto" style="width: 500px;">
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">BirthDay</th>
            </tr>
        </thead>
        <tbody>
<?php

  $index = 1;
  while ( ($r = $res->fetch_array()) ) {
?>
<tr>
    <td>
        <?php echo $index; $index = $index + 1; ?>
    </td>
    <td>
        <a href="show_actor.php?code=<?php echo $r["id"]?>">
            <?php echo $r["first"]."  ".$r["last"]; ?>
        </a>
    </td>
    <td> 
        <a href="show_actor.php?code=<?php echo $r["id"]?>">
            <?php echo $r["dob"]; ?>
        </a>
    </td>
</tr>
      <?php } ?> 
      </tbody>
      </table>
</div>



<?php 
  } 
}
?>
</div>
</div>



</body>
</html>

