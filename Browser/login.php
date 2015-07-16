<!DOCTYPE html>

<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>CheckParking - LOGIN</title>
  </head>
  <body>
    <!-- Web page's body is here -->
    Here's the login page.<br \>

    <?php
      $hash = "Tx9BcuRZh5FksUq";

      session_start();

      mysqli_report(MYSQLI_REPORT_ERROR);
      try {
        $mysqli = new mysqli("localhost", "root", "");                      // Connect MySQL Server.
        $mysqli->set_charset("utf8");                                       // Choose Character.
        $mysqli->select_db("LoginDB");                                      // Select the Database.
      } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
      }

      $status = "none";

      if (isset($_SESSION["user"])) {
        $status = "LoggedIn";
      } elseif (!empty($_POST["tb_user"]) && !empty($_POST["tb_pass"])) {
        $password = md5($_POST["tb_pass"] . $hash);

        $check = $mysqli->prepare("SELECT * FROM UserInfo WHERE user = ? AND pass = ?");
        $check->bind_param("ss", $_POST["tb_user"], $password);
        $check->execute();
        $check->store_result();

        if ($check->num_rows == 1) {
          $status = "ok";
          printf("Success!\n");
          $_SESSION["user"] = $_POST["tb_user"];
        } else {
          $status = "failed";
          printf("Failed!\n");
        }
      }

      session_destroy();
    ?>

    <form name="loginForm" method="POST" action="" id="loginForm_id">
      User:
      <input type="text" name="tb_user" id="tb_user_id" value="" autocomplete="off">
      Password:
      <input type="text" name="tb_pass" id="tb_pass_id" value="" autocomplete="off">
      <input type="submit" name="btn_login" id="btn_login_id" value="Login">
    </form>

    <footer>
    </footer>
  </body>
</html>
