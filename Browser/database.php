<!DOCTYPE html>
<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>CheckParking - DATABASE</title>
  </head>
  <body>
    <!-- Web page's body is here -->
    Here's the database page.<br \>

    <?php
      // Open the Database.
      $mysqli = new mysqli("localhost", "root", "");
      $connectDB = $mysqli->connect_error;
      if ($connectDB)
        die("Cannot Open the Database: " . $mysqli->connect_error);

      // Create the Database.
      $createDB = $mysqli->query("CREATE DATABASE IF NOT EXISTS CarNumberDB");
      if (!$createDB)
        die("Cannot Create the Database: " . $mysqli->error);

      // Select the Database.
      $selectDB = $mysqli->select_db("CarNumberDB");
      if (!$selectDB)
        die("Cannot Select the Database: " . $mysqli->error);

      // Create Table in the Database.
      $createTable = $mysqli->query("CREATE TABLE IF NOT EXISTS CarNumberDB.CarNumber(carNums INTEGER, deps TEXT, attrs TEXT)");
      if (!$createTable)
        die("Cannot Create Table in the Database: " . $mysqli->error);

      // Get Datas from the Database.
      $fetchDB = $mysqli->query("SELECT * from CarNumberDB.CarNumber", MYSQLI_USE_RESULT);
      if (!$fetchDB) {
        die("Cannot Get Datas from the Database: " . $mysqli->error);
      } else {
          while ($row = $fetchDB->fetch_row()) {
            printf("%d, %s, %s<br \>", $row[0], $row[1], $row[2]);
          }

          $fetchDB->close();
      }

      // Close the Database.
      $closeDB = $mysqli->close();
      if (!$closeDB)
        die("Cannot Close the Database: " . $mysqli->error);
    ?>

    <form name="go_to_index" method="send" action="index.php">
      <input type="button" onclick="location.href='index.php'" value="Go to index">
    </form>
    
    <footer>
    </footer>
  </body>
</html>
