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
      if ($mysqli->connect_error) {
        die("Cannot Open the Database: " . $mysqli->connect_error);
      } else {
        printf("Open the Database Successfully!<br \>");
      }

      // Create the Database.
      $createDB = $mysqli->query("CREATE DATABASE IF NOT EXISTS CarNumberDB");
      if (!$createDB) {
        printf("Cannot Create the Database: %s<br \>", $mysqli->error);
      } else {
        printf("Create the Database Successfully!<br \>");
      }

      // Select the Database.
      $selectDB = $mysqli->select_db("CarNumberDB");
      if (!$selectDB) {
        printf("Cannot Select the Database: %s<br \>", $mysqli->error);
      } else {
        printf("Select the Database Successfully!<br \>");

        // Get the Selected Database's Name.
        $getDBName = $mysqli->query("SELECT DATABASE()");
        if (!$getDBName) {
          printf("Cannot Get the Database's Name: %s<br \>", $mysqli->error);
        } else {
          $DBName = $getDBName->fetch_row();
          printf("Selected Database is %s.<br \>", $DBName[0]);
          $getDBName->close();
        }

        // Create Table in the Database.
        $createTable = $mysqli->query("CREATE TABLE IF NOT EXISTS CarNumberDB.CarNumber(carNums INTEGER, deps TEXT, attrs TEXT)");
        if (!$createTable) {
          printf("Cannot Create Table in the Database: %s<br \>", $mysqli->error);
        } else {
          printf("Create the Table Successfully!<br \>");
        }

        // Get Datas from Database.
        $fetchDB = $mysqli->query("SELECT * from CarNumberDB.CarNumber", MYSQLI_USE_RESULT);
        if (!$fetchDB) {
          printf("Cannot Get Datas from the Database: %s<br \>", $mysqli->error);
        } else {
          while ($row = $fetchDB->fetch_row()) {
            printf("%d, %s, %s<br \>", $row[0], $row[1], $row[2]);
          }

          $fetchDB->close();
        }
      }

      // Close the Database.
      $closeDB = $mysqli->close();
      if (!$closeDB) {
        printf("Cannot Close the Database: %s<br \>", $mysqli->error);
      } else {
        printf("Close the Database Successfully!<br \>");
      }
    ?>

    <form name="go_to_index" method="send" action="index.php">
      <input type="button" onclick="location.href='index.php'" value="Go to index">
    </form>
    
    <footer>
    </footer>
  </body>
</html>
