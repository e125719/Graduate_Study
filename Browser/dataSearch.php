<!DOCTYPE html>

<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>CheckParking - DATABASE SEARCH</title>
  </head>
  <body>
    <!-- Web page's body is here -->
    Here's searching the database page.<br \>

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

    <form name="searchForm" method="POST" action="" id="searchForm_id">
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
      <input type="submit" name="btn_exec" id="btn_exec_id" value="Search">
    </form>

    <form name="go_to_index" method="send" action="index.php">
      <input type="button" value="Go to index" onclick="location.href='index.php'">
    </form>

    <hr>

    <?php
      $fetch = "SELECT * FROM CarNumberDB.CarNumber";

      // Set a flag.
      $flagArray = array('0', '0', '0');

      if ($input_nums = $_POST['tb_nums']) {
        $flagArray[0] = '1';
      }
      if ($flag_deps = $_POST['pd_deps']) {
        $flagArray[1] = '1';
      }
      if ($flag_attrs = $_POST['pd_attrs']) {
        $flagArray[2] = '1';
      }

      // Make an Order to Fetch from the Database.
      $flag = $flagArray[0] . $flagArray[1] . $flagArray[2];
      switch ($flag) {
        case '100':
          $fetch .= " WHERE carNums = " . $input_nums;
          break;
        case '010':
          $fetch .= " WHERE deps = '" . $input_deps . "'";
          break;
        case '001':
          $fetch .= " WHERE attrs = '" . $input_attrs . "'";
          break;
        case '110':
          $fetch .= " WHERE carNums = " . $input_nums . " AND deps = '" . $input_deps . "'";
          break;
        case '101':
          $fetch .= " WHERE carNums = " . $input_nums . " AND attrs = '" . $input_attrs . "'";
          break;
        case '011':
          $fetch .= " WHERE deps = '" . $input_deps . "' AND attrs = '" . $input_attrs . "'";
          break;
        case '111':
          $fetch .= " WHERE carNums = " . $input_nums . " AND deps = '" . $input_deps . "' AND attrs = '" . $input_attrs . "'";
          break;
        default:
          break;
      }

      // Fetch Results from the Database.
      $result = $mysqli->query($fetch, MYSQLI_USE_RESULT);
      if (!$result) {
        printf("Cannot Fetch Datas from the Database!: %s<br \>", $mysqli->error);
        $result->close();
      } else {
        while ($row = $result->fetch_row()) {
          printf("%d, %s, %s<br \>", $row[0], $row[1], $row[2]);
        }

        $result->close();
      }
    ?>

    <hr>
    
    <footer>
    </footer>
  </body>
</html>
