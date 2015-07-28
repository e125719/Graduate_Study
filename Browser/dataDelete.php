<!DOCTYPE html>

<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>CheckParking - DATABASE DELETE</title>
  </head>
  <body>
    <!-- Web page's body is here -->
    Here's deleting datas from the database page.<br \>

    <?php
      mysqli_report(MYSQLI_REPORT_ERROR);
      try {
        $mysqli = new mysqli("localhost", "root", "");                      // Connect MySQL Server.
        $mysqli->set_charset("utf8");                                       // Choose Character.
        $mysqli->query("CREATE DATABASE IF NOT EXISTS CarNumberDB");        // Create the Database.
        $mysqli->select_db("CarNumberDB");                                  // Select the Database.
        $mysqli->query("CREATE TABLE IF NOT EXISTS 
          OwnerInfo(name TEXT, deps TEXT, attrs TEXT)");                    // Create the Table.
      } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
      }
    ?>

    <form name="deleteForm" method="POST" action="" id="deleteForm_id">
      Name:
      <input type="text" name="tb_name" id="tb_name_id" value="" autocomplete="off">
      Attrs:
      <select name="pd_attrs">
        <option value="attrs_n"></option>
        <option value="attrs_s">Student</option>
        <option value="attrs_t">Teacher</option>
        <option value="attrs_o">Others</option>
      </select>
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
      <input type="submit" name="btn_exec" id="btn_exec_id" value="Delete">
    </form>

    <form name="go_to_index" method="send" action="index.php">
      <input type="button" value="Go to index" onclick="location.href='index.php'">
    </form>

    <?php
      $tb_name = "";
      $flag_deps = "";
      $flag_attrs = "";

      // Set a flag.
      $flagArray = array('0', '0', '0');
      if ($flag_name = $_POST['tb_name']) {
        $input_name = addslashes($_POST['tb_name']);
        $flagArray[0] = '1';
      }
      if ($flag_deps = $_POST['pd_deps']) {
        $flagArray[1] = '1';
      }
      if ($flag_attrs = $_POST['pd_attrs']) {
        $flagArray[2] = '1';
      }

      // Switch If "flag_deps" is Set.
      switch ($flag_deps) {
        case "deps_1":
          $input_deps = "Law and Literature";
          break;
        case "deps_2":
          $input_deps = "Tourism and Management";
          break;
        case "deps_3":
          $input_deps = "Education";
          break;
        case "deps_4":
          $input_deps = "Science";
          break;
        case "deps_5":
          $input_deps = "Medical";
          break;
        case "deps_6":
          $input_deps = "Engineering";
          break;
        case "deps_7":
          $input_deps = "Agricalture";
          break;
        default:
          $flagArray[1] = "0";
          break;
      }

      // Switch If "flag_attrs" is Set.
      switch ($flag_attrs) {
        case "attrs_s":
          $input_attrs = "Student";
          break;
        case "attrs_t":
          $input_attrs = "Teacher";
          break;
        case "attrs_o":
          $input_attrs = "Others";
          break;
        default:
          $flagArray[2] = "0";
          break;
      }

      // Make an Order to Delete from the Database.
      $flag = $flagArray[0] . $flagArray[1] . $flagArray[2];
      switch ($flag) {
        case '100':
          $deleteQuery = $mysqli->prepare("DELETE FROM OwnerInfo WHERE name = ?");
          $deleteQuery->bind_param("s", $input_name);
          break;
        case '010':
          $deleteQuery = $mysqli->prepare("DELETE FROM OwnerInfo WHERE deps = ?");
          $deleteQuery->bind_param("s", $input_deps);
          break;
        case '001':
          $deleteQuery = $mysqli->prepare("DELETE FROM OwnerInfo WHERE attrs = ?");
          $deleteQuery->bind_param("s", $input_attrs);
          break;
        case '110':
          $deleteQuery = $mysqli->prepare("DELETE FROM OwnerInfo WHERE name = ? AND deps = ?");
          $deleteQuery->bind_param("ss", $input_name, $input_deps);
          break;
        case '101':
          $deleteQuery = $mysqli->prepare("DELETE FROM OwnerInfo WHERE name = ? AND attrs = ?");
          $deleteQuery->bind_param("ss", $input_name, $input_attrs);
          break;
        case '011':
          $deleteQuery = $mysqli->prepare("DELETE FROM OwnerInfo WHERE deps = ? AND attrs = ?");
          $deleteQuery->bind_param("ss", $input_deps, $input_attrs);
          break;
        case '111':
          $deleteQuery = $mysqli->prepare("DELETE FROM OwnerInfo WHERE name = ? AND deps = ? AND attrs = ?");
          $deleteQuery->bind_param("sss", $input_name, $input_deps, $input_attrs);
          break;
        default:
          break;
      }

      // Delete Datas from the Database.
      $result = $mysqli->query($delete);
      if (!$result) {
        printf("Cannot Delete Datas from the Database!: %s<br \>", $mysqli->error);
      } else {
        printf("Delete Datas from the Database Successfully!<br \>");
      }
    ?>

    <footer>
    </footer>
  </body>
</html>
