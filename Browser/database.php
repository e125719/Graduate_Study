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
        die("Can't Open the Database: " . $mysqli->connect_error);
      } else {
        printf("Open the Database Successfully!<br \>");
      }

      // Close the Database.
      $closeDB = $mysqli->close();
      if (!$closeDB) {
        printf("Can't Close the Database: %s<br \>", $mysqli->error);
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
