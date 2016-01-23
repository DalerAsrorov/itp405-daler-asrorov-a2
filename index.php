<!DOCTYPE>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title> DVD Search </title>
</head>
<body>

<div class="container">
  <div id="form-search">
    <form action="results.php" method="get">
      <span class="header-text"> <h2> DVD Search </h2> </span>
      <div class="input-group">
        <input type="text" class="form-control" name="movie" placeholder="Search for the movie...">
        <span class="input-group-btn">
          <button class="btn btn-info" type="submit">Go!</button>
        </span>
      </div>
    </form>
  </div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>
