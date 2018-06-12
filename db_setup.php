<?
echo "<br /><br /><br /><br />";
// Extend the SQLite3 class and change the __construct parameters
class MyDB extends SQLite3 {
  function __construct() {
  $this->open('mysqlitedb1.db');
  }
}
// Use open method to initialize the DB
$db = new MyDB();
if (!$db) {
  echo $db->lastErrorMsg();
}

if (isset($_POST['init'])) {
// Create a table
  $sql =<<<EOF
    DROP            TABLE           SURVEY;
    CREATE          TABLE           SURVEY
    (ID             INTEGER PRIMARY KEY AUTOINCREMENT,
    USERNAME        TEXT            NOT NULL,
    WINDOWHEIGHT    INT,
    WINDOWWIDTH     INT,
    EMAIL           NVARCHAR(50),
    COMMENTS        CHAR(100),
    RATING          INT);
EOF;
  $ret = $db->exec($sql);
  if (!$ret) {
    echo $db->lastErrorMsg();
   }

// Delete records
  $sql =<<<EOF
    DELETE from SURVEY where ID < 3;
EOF;
  $ret = $db->exec($sql);
  if(!$ret){
    echo $db->lastErrorMsg();
  }

// Create records
  $sql =<<<EOF
    INSERT INTO SURVEY (ID,USERNAME,EMAIL,COMMENTS,RATING)
    VALUES (1, 'Mary', 'mary@com', 'Great app',     5);
    INSERT INTO SURVEY (ID,USERNAME,EMAIL,COMMENTS,RATING)
    VALUES (2, 'Bob',  'bob@com',  'Whats an IUD?', 1);
EOF;
  $ret = $db->exec($sql);
  if(!$ret) {
     echo $db->lastErrorMsg();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Contraceptive Decision Support Tool: Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="library/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link   rel="stylesheet" type="text/css" href="css/checkbox1.css"/> 
</head>

<body>

<div class="container" style="margin-top:0px">
  <nav class="navbar navbar-inverse navbar-fixed-top nav-pills" id="navbar-data-spy">
    <span class="navbar-brand" href="#">Contraceptive Decision Support Tool</span>
    <ul class="nav nav-pills">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
        <ul class="dropdown-menu">
          <li><a style="font-size:125%" href="index.php"    >Home  </a></li>
          <li><a style="font-size:125%" href="bs_survey.php">Survey</a></li>
          <li><a style="font-size:125%" href="db_setup.php" >Admin </a></li>
        </ul>
      </li>
    </ul>
  </nav>
</div>

<div class="bg-primary" style="padding:10px 10px 10px 10px">
  <h3>Data base of user responses</h3>
  <h4>Best seen on a laptop or tablet</h3>
</div>

<div class="container-fluid" style="margin-top:40px">
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>User name</th>
        <th>Email</th>
        <th>Rating</th>
        <th>Comments</th>
      </tr>
    </thead>
    <tbody>

<?
// Print records
$sql =<<<EOF
  SELECT * from SURVEY;
EOF;

$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
  echo "<tr>\n";
  echo "<td>". $row['ID']       ."</td>\n";
  echo "<td>". $row['USERNAME'] ."</td>\n";
  echo "<td>". $row['EMAIL']    ."</td>\n";
  echo "<td>". $row['RATING']   ."</td>\n";
  echo "<td><textarea style='width: 100%; height: 100%; border: none'>" . $row['COMMENTS'] ."</textarea></td>\n";
  echo "</tr>\n";
}

// Close DB
$db->close();

?>

    </tbody>
  </table>
</div>
</div>
<br />
<br />
<br />

<div style="background-color:LightGray; padding:10px 10px 10px 10px">    
  <h4>For programmers only:</h4>

  <div class="container-fluid" style="margin-top:40px">
    <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#myModal">Initialize database</button>
  </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">WARNING: All data will be erased!</h4>
      </div>
      <div class="modal-body">
        <p>Select x in the upper right to cancel</p>
      </div>
      <div class="modal-footer">
        <form method='post' action='' enctype='multipart/form-data'>
          <button type="submit" class="btn btn-danger btn-lg" name="init">Erase and initialize the database</button>
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </form>
      </div>
    </div>      
  </div>
</div>

</body>
</html>
