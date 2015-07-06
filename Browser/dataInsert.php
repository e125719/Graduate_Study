<!DOCTYPE html>

<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>CheckParking - DATABASE INSERT</title>
  </head>
  <body>
    <!-- Web page's body is here -->
    Here's inserting datas into the database page.<br \>

    <?php
      mysqli_report(MYSQLI_REPORT_ERROR);
      try {
        $mysqli = new mysqli("localhost", "root", "");                      // Connect MySQL Server.
        $mysqli->set_charset("utf8");                                       // Choose Character.
        $mysqli->query("CREATE DATABASE IF NOT EXISTS CarNumberDB");        // Create the Database.
        $mysqli->select_db("CarNumberDB");                                  // Select the Database.
        $mysqli->query("CREATE TABLE IF NOT EXISTS 
          CarNumberDB.CarNumber(carNums INTEGER, deps TEXT, attrs TEXT)");  // Create the Table.
      } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
      }
    ?>

    <form name="insertForm" method="POST" action="" id="insertForm_id">
      CarNumbers:
      <input type="text" name="tb_nums" id="tb_nums_id" value="">
      Deps:
      <select name="pd_deps">
        <option value="deps_0"></option>
        <option value="deps_1">Law and Literature</option>
        <option value="deps_2">Tourism and Management</option>
        <option value="deps_3">Education</option>
        <option value="deps_4">Science</option>
        <option value="deps_5">Medical</option>
        <option value="deps_6">Engineering</option>
        <option value="deps_7">Agricalture</option>
      </select>
      Attrs:
      <select name="pd_attrs">
        <option value="attrs_n"></option>
        <option value="attrs_s">Student</option>
        <option value="attrs_t">Teacher</option>
      </select>
      <input type="submit" name="btn_exec" id="btn_exec_id" value="Insert">
    </form>

    <form name="go_to_index" method="send" action="index.php">
      <input type="button" value="Go to index" onclick="location.href='index.php'">
    </form>

    <?php
      $insert = "INSERT INTO CarNumberDB.CarNumber (";

      // Set a flag.
      $flagArray = array('0', '0', '0');

      if ($input_nums = $_POST['tb_nums']) {
        $flagArray[0] = '1';
      }
      if ($flag_deps = $_POST['pd_deps'] ) {
        $flagArray[1] = '1';
      }
      if ($flag_attrs = $_POST['pd_attrs'] ) {
        $flagArray[2] = '1';
      }

      // Make an Order to Insert Datas into the Database.
      $flag = $flagArray[0] . $flagArray[1] . $flagArray[2];
      switch ($flag) {
        case '100':
          $insert .= "carNums) VALUES(" . $input_nums . ")";
          break;
        case '010':
          $insert .= "deps) VALUES('" . $input_deps . "')";
          break;
        case '001':
          $insert .= "attrs) VALUES('" . $input_attrs . "')";
          break;
        case '110':
          $insert .= "carNums, deps) VALUES(" . $input_nums . ", '" . $input_deps . "')";
          break;
        case '101':
          $insert .= "carNums, attrs) VALUES(" . $input_nums . ", '" . $input_attrs . "')";
          break;
        case '011':
          $insert .= "deps, attrs) VALUES('" . $input_deps . "', '" . $input_attrs . "')";
          break;
        case '111':
          $insert .= "carNums, deps, attrs) VALUES(" . $input_nums . ", '" . $input_deps . "', '" . $input_attrs . "')";
          break;
        default:
          break;
      }

      // Insert Datas into Database.
      $result = $mysqli->query($insert);
      if (!$result) {
        printf("Cannot Insert Datas into the Database!: %s<br \>", $mysqli->error);
      } else {
        printf("Insert Datas into the Database Successfully!<br \>");
      }
    ?>

    <hr>

    <footer>
    </footer>
  </body>
</html>
