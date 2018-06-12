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

// Table already created in db_setup.php
// Update records
// put any form comments in variable
if (isset($_POST['comments'])) {
  $comments = $_POST['comments'];
} else {
  $comments = '';
}

if (isset($_POST['rating'])) {
  $rating = $_POST['rating'];
} else {
  $rating = '';
}

// $myRating->rating = $rating;
// $myJSON = json_encode($myRating);
// echo $myJSON;

if (isset($_POST['email'])) {
  $email = $_POST['email'];
} else {
  $email = '';
}

if (!isset($_POST['username'])) {
//$username = '';
} else {
  $username = $_POST['username'];
  $sql =<<<EOF
    SELECT * from SURVEY where USERNAME = '$username';
EOF;
  $ret = $db->query($sql);
  $row = $ret->fetchArray(SQLITE3_ASSOC);

  if($row<1) {
    echo "  User name not found, creating new record:<br />\n";
  $sql =<<<EOF
    INSERT INTO SURVEY (ID,USERNAME) VALUES (NULL,'$username');
EOF;
    print_r($sql);
    $ret = $db->exec($sql);
    print_r($ret);
    if(!$ret) {
       echo $db->lastErrorMsg();
    }
  } else {

    if (strlen($email)<2) {
      // echo "email:<br />";
      // $sql = 'SELECT EMAIL from SURVEY where USERNAME = "' . $username . '"';
      // $ret = $db->query($sql);
      // $row = $ret->fetchArray(SQLITE3_ASSOC);
      $email = print_r($row['EMAIL'], true);
      print_r($email);
    } else {
      echo "update or resave email: $email<br />";
      $sql = 'UPDATE SURVEY set EMAIL = "' . $email . '" where USERNAME = "' . $username . '"';
      $ret = $db->exec($sql);
      if(!$ret) {
        echo $db->lastErrorMsg();
      }
    }

    if (strlen($rating)===0) {
      $rating = print_r($row['RATING'], true);
    } else {
      $sql = 'UPDATE SURVEY set RATING = "' . $rating . '" where USERNAME = "' . $username . '"';
      $ret = $db->exec($sql);
      if(!$ret) {
         echo $db->lastErrorMsg();
      }
    }

    if (strlen($comments)<2) {
      // $sql = 'SELECT COMMENTS from SURVEY where USERNAME = "' . $username . '"';
      // $ret = $db->query($sql);
      // $row = $ret->fetchArray(SQLITE3_ASSOC);
      $comments = print_r($row['COMMENTS'], true);
    } else {
      $sql = 'UPDATE SURVEY set COMMENTS = "' . $comments . '" where USERNAME = "' . $username . '"';
      $ret = $db->exec($sql);
      if(!$ret) {
         echo $db->lastErrorMsg();
      }
    }
  }
}

// Close DB
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Contraceptive Decision Support Tool: Survey</title>
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

<div class="container" style="margin-top:50px"; width:100%>
  <div class="bg-primary" style="padding:10px 10px 10px 10px">
    <h3>User survey</h3>
  </div>
  <form method='post' class='form-inline' action='' enctype='multipart/form-data'; width:100%>
    <div style="background-color:Lavender; padding:10px 10px 10px 10px"; width:100%>
      <div class="form-group">
        <h4>STEP 1: Create or find user profile</h4>
        <br />

        <label for="username">Use your initials for user ID:</label>
        <br />
        <input type="text" class="form-control" id="username" name="username" value=
<?
echo '"' . $username . '"';
?>
>
      </div>
      <br />
      <button type="submit" class="btn btn-primary">Create new user or recall saved user comments</button>
      <br />
    </div>
<!-- 
  </form>

  <form method='post' class='form-inline' action='' enctype='multipart/form-data'> -->
    <div style="background-color:Azure; padding:10px 10px 10px 10px; width:100%">    
      <br />
      <h4>STEP 2: Fill out survey</h4>
      <br />

      <!-- <input type="text" class="form-control" id="wHeight" name="wHeight" value="200"> -->

      <div class="form-group">
        <label for="email">Email address (optional):</label>
        <br />
        <input type="email" class="form-control" id="email" name="email" value=
<?
echo '"' . $email . '"';
?>
>
      </div>
      <br />
<!-- 
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd">
    </div> 
-->
      <div class="form-group">
        <label for="rating">Rating from 1-5 (5 is best):</label>
        <br />
        <select class="form-control" id="rating" name="rating">
          <option id="rating" selected></option>
          <option id="rating1">1</option>
          <option id="rating2">2</option>
          <option id="rating3">3</option>
          <option id="rating4">4</option>
          <option id="rating5">5</option>
        </select>
      </div>
      <br />
   
      <div class="form-group" style="width:100%">
        <label for="comments">Comments (can be recalled and revised):</label>
        <br />
        <!-- <textarea class="form-control" rows="10" id="comments" name="comments"> -->
        <textarea class="form-control" rows="12" style="width:100%" id="comments" name="comments">
<?
echo $comments;
?>
</textarea>
<!-- make sure there is no extra spaces above -->
      </div>
      <br />
<!-- 
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div> 
-->
      <button type="submit" class="btn btn-success">Save rating and comments</button>
      <br />
    </div>
  </form>
</div>

<script>
  var ratingID = "rating" + 
<?
echo $rating;
echo ";";
?>

  console.log(ratingID);

  document.getElementById(ratingID).selected = true;

</script>
</body>
</html>

