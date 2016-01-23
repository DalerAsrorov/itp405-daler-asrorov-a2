<?php

if(!isset($_GET['movie'])) {
  header('Location: index.php');
  exit();
}

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$username = 'student';
$pw = 'ttrojan';

$movie = $_GET['movie']; // $_REQUEST['artist']

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pw);

// $sql = "
//   SELECT title, price, play_count, artist_name
//   FROM songs, artists
//   WHERE songs.artist_id = artists.id
// ";

$sql = "
    SELECT title, genre_name, format_name, rating_name
    FROM dvds
    LEFT JOIN genres
    ON dvds.genre_id = genres.id
    LEFT JOIN formats
    ON dvds.format_id = formats.id
    LEFT JOIN ratings
    ON dvds.rating_id = ratings.id
    WHERE title LIKE ?
";

$statement = $pdo->prepare($sql);
$like = '%' . $movie . '%';
$statement->bindParam(1, $like);
$statement->execute();
$movies = $statement->fetchAll(PDO::FETCH_OBJ); // static property


echo "$numOfMovies";
//var_dump($songs);

//echo $songs[0]['title'];
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
    <?php echo "You searched for '" . $movie . "'"; ?>
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
