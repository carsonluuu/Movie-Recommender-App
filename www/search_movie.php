<?php include './header.php'; ?>

<div class="container mx-auto" style="padding-left: 50px; padding-right: 50px">
<br>
<br>
<div class="jumbotron">
    <div id="landing-header">
      <h1 class="text-center">Search for Movies!</h1>
      <br>
      <hr>
      <br>
      <br>
        <form class="form-inline" method = "GET" action="./search_movie.php">
        <div class="input-group col-lg-6 w-50 mx-auto">
            <div class="input-group-prepend">
            <a class="btn btn-outline-secondary" type="button" href="./index.php" role = "button">GO BACK</a>
            </div>
            <input type="text" class="form-control col-lg-9" name="search_movie" aria-label="Text input with dropdown button" value="<?php echo $_GET['search_movie'];?>">
            <input type="submit" value="GO!" class="btn btn-primary search-box">
        </div>
        </form>
      </div>


<?php 
  $movie = $_GET["search_movie"];
  $db = new mysqli("localhost", "cs143", "", "CS143");
  if ($db->connect_errno > 0) {
      die('Unable to connect to database [' . $db->connect_error . ']');
  }
  if ($movie == "") {
    ;
  } else {
    $query = "SELECT id, title, year FROM Movie WHERE title LIKE '%$movie%'";

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
  <h4 class="text-center">Related Matching Movies are listed in table below:</h4> 
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
}
?>

</div>
</div>


</body>
</html>

