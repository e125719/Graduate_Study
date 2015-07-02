<!DOCTYPE html>

<html lang="ja">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>CheckParking - TOP</title>
  </head>
  <body>
    <!-- Web page's body is here -->
    Here's the index page.<br \>

    <form name="go_to_search" method="send" action="dataSearch.php">
      <input type="button" onclick="location.href='dataSearch.php'" value="Go to searching datas page">
    </form>

    <form name="go_to_insert" method="send" action="dataInsert.php">
      <input type="button" onclick="location.href='dataInsert.php'" value="Go to inserting datas page">
    </form>
    
    <form name="go_to_delete" method="send" action="dataDelete.php">
      <input type="button" onclick="location.href='dataDelete.php'" value="Go to deleting datas page">
    </form>

    <footer>
    </footer>
  </body>
</html>
