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
      mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_STRICT);
      try {
        $mysqli = new mysqli("localhost", "root", "");                      // Connect MySQL Server.
        $mysqli->set_charset("utf8");                                       // Choose Character.
        $mysqli->query("CREATE DATABASE IF NOT EXISTS CarNumberDB");        // Create the Database.
        $mysqli->select_db("CarNumberDB");                                  // Select the Database.
        $mysqli->query("CREATE TABLE IF NOT EXISTS 
          CarNumberDB.CarNumber(carNums INTEGER, deps TEXT, attrs TEXT)");  // Create the Table.
        $mysqli->close();                                                   // Close MySQL Server.
      } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
      }
    ?>

    <form name="go_to_index" method="send" action="index.php">
      <input type="button" onclick="location.href='index.php'" value="Go to index">
    </form>
    
    <footer>
    </footer>
  </body>
</html>
