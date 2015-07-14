<!DOCTYPE html>

<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>CheckParking - REGISTER</title>
  </head>
  <body>
    <!-- Web page's body is here -->
    Here's the register page.<br \>

    <?php
      $hash = "Tx9BcuRZh5FksUq";

      mysqli_report(MYSQLI_REPORT_ERROR);
      try {
        $mysqli = new mysqli("localhost", "root", "");                      // Connect MySQL Server.
        $mysqli->set_charset("utf8");                                       // Choose Character.
        $mysqli->query("CREATE DATABASE IF NOT EXISTS UserDB");             // Create the Database.
        $mysqli->select_db("UserDB");                                       // Select the Database.
        $mysqli->query("CREATE TABLE IF NOT EXISTS 
          UserDB.UserInfo(name TEXT, attrs TEXT, deps TEXT)");              // Create the Table.
      } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
      }
    ?>

    <footer>
    </footer>
  </body>
</html>
