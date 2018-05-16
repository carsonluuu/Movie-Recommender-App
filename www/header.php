<!DOCTYPE html>
<html>
<head>
  <title>CS143 Project 1C</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./asset/bootstrap.min.css">
  <script src="./asset/jquery-3.3.1.min.js"></script>
  <script src="./asset/popper.min.js"></script>
  <script src="./asset/bootstrap.min.js"></script>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">CS143</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">HOME <span class="sr-only">(current)</span></a>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="./index.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ADDING
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./page_l1.php">Add Actor/Director</a>
          <a class="dropdown-item" href="./page_l2.php">Add Movie Information</a>
          <a class="dropdown-item" href="./page_l3.php">Add Actor/Movie Relation</a>
          <a class="dropdown-item" href="./page_l4.php">Add Director/Movie Relation</a>
        </div>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          BROWSERING
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./search_actor.php">Show Actor Information</a>
          <a class="dropdown-item" href="./search_movie.php">Show Movie Information</a>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link active" href="./comment.php">COMMENT</a>
      </li>

      <li class="nav-item">
        <a class="nav-link active" href="./about.php">ABOUT</a>
      </li>

    </ul>

    <form class="form-inline my-2 my-lg-0" method="GET" action="./search_all.php">
      <input class="form-control mr-sm-2" type="search" placeholder="Global Search" aria-label="Search" name="search_all" value="<?php echo $_GET['search_all'];?>">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>