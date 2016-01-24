<?php
  if(!isset($_GET['rating_name'])) {
    header('Location: index.php');
    exit();
  }

  $host = 'itp460.usc.edu';
  $dbname = 'dvd';
  $username = 'student';
  $pw = 'ttrojan';

  // get the rating from the results page
  $rating = $_GET['rating_name'];

  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pw);

  $sql = "
      SELECT title, genre_name, format_name, rating_name
      FROM dvds
      INNER JOIN genres
      ON dvds.genre_id = genres.id
      INNER JOIN formats
      ON dvds.format_id = formats.id
      INNER JOIN ratings
      ON dvds.rating_id = ratings.id
      WHERE rating_name = ?
  ";

  $statement = $pdo->prepare($sql);
  $rating_name = $rating;
  $statement->bindParam(1, $rating_name);
  $statement->execute();
  $movies = $statement->fetchAll(PDO::FETCH_OBJ); // static property

?>

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

<div class="query">
  <h1>
    <?php echo "The following results are for '" . $rating . "' rating. "; ?>
  </h1>
</div>
<?php foreach($movies as $movie) : ?>
  <div class="box">
    <div class="panel panel-default no-margins header-text">
      <h3>
        <?php echo $movie->title ?>
      </h3>
    </div>
    <div class="content">
      <table class="table">
        <tr>
          <td><span class="left"> Format: </span></td>
          <td><span> <?php echo $movie->format_name ?> </span>
        </tr>
        <tr>
          <td><span class="left"> Genre: </span></td>
          <td><span> <?php echo $movie->genre_name ?> </span></td>
        </tr>
        <tr>
          <td><span class="left"> Rating: </span></td>
          <td>
            <span>
              <?php
                echo "<a href=" . "ratings.php?rating_name=" . $movie->rating_name . ">" . $movie->rating_name . "</a>";
              ?>
            </span>
          </td>
        </tr>
      </table>
    </div>
  </div>
<?php endforeach; ?>


<div class="not-found">
  <?php
    // Show the following if the query
    // does not return any results
    if(!$movies) {
      echo "<h1>No Records Found. </h1> <br>";
      echo "<p><a href='index.php' class='not-found-p'> Go back to search. </a> </p>";
    }
  ?>
</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>
