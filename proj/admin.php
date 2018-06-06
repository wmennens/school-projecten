<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>FBZ</title>
  </head>
  <body>
  <div class="logo"><a href="index.php"><img src="logo.png" alt="logo"></a></div>
  <p>main page uploads</p>
    <form id="allesinalles" enctype="multipart/form-data" action="" method="post">
        <label>upload hier de fotos en info voor de main page</label><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="500000000">
      <input id="blad" type="file" name="image" /><br>
      <label for="description">Omschrijving (max. 140 tekens)</label>
      <textarea name="description" id="description"></textarea><br>
      <input type="submit" id="upmaar" name="submit-upload" value="Uploaden maar!">
    </form>


        <form id="delenup" enctype="multipart/form-data" action="" method="post">
            <label>delete mensen hier via de id</label><br>
            <input type="submit" id="del" name="submit-del" value="delete">
            <input name="tdel" id="tdel"><br>
            <label>update mensen hun gegevens hier</label><br>
            <input type="submit" id="up" name="submit-up" value="update"><br>
            <label for="id">id</label><br>
            <input name="tup" id="tup"><br>
            <label for="user">user</label><br>
            <input name="tup" id="upuser"><br>
            <label for="second">second</label><br>
            <input name="tup" id="upsecond"><br>
            <label for="name">name</label><br>
            <input name="tup" id="upname"><br>
            <label for="password">password</label><br>
            <input name="tup" id="uppass"><br>
        </form>
    <?php
      session_start();
      if (isset($_POST['submit-upload'])) {
        $dbc = mysqli_connect('localhost','root','','14511_database') or die ('ERROR!');
        $description = mysqli_real_escape_string($dbc,trim($_POST['description']));
        $target = 'images/' . $_FILES['image']['name'];
        $account = 'Admin';
        echo $target;
        $temp = $_FILES['image']['tmp_name'];
        if (!empty($description)) {
          $succes = move_uploaded_file($temp,$target);
          if ($succes) {
            echo '<br> upload Gelukt!<br>';
            $query= "INSERT INTO `14511_proj_admin` (`description`,`target`,`account` ) VALUES ('".$description."', '".$target."','".$account."')";
            echo $query;
            $result = mysqli_query($dbc, $query) or die('Error querying database');
            mysqli_close($dbc);
          } else {
            echo 'Mislukt.';
            $error = $_FILES['image']['error'];
            if ($error == 2) {
              echo 'Whut? Zo groot?';
            }
          }
        }
      }


    if (isset($_POST['submit-del'])) {
        $dbc = mysqli_connect('localhost','root','','14511_database') or die ('ERROR!');
        $id = mysqli_real_escape_string($dbc,trim($_POST['del']));
        $query = "DELETE FROM 14511_proj WHERE id=$id";

        if ($dbc->query($query) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: ";
        }

        $dbc_close($dbc);
    }
    if (isset($_POST['submit-del'])) {
        $dbc = mysqli_connect('localhost','root','','14511_database') or die ('ERROR!');
        $id = mysqli_real_escape_string($dbc,trim($_POST['tup']));
        $username = mysqli_real_escape_string($dbc,trim($_POST['upuser']));
        $secondname = mysqli_real_escape_string($dbc,trim($_POST['upsecond']));
        $name = mysqli_real_escape_string($dbc,trim($_POST['upname']));
        $password = mysqli_real_escape_string($dbc,trim($_POST['uppasss']));
        $query = "UPDATE 14511_proj SET secondname=$secondname username=$username name=$name password=$password WHERE id=$id";

        if ($dbc->query($query) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record";
        }

        $dbc_close($dbc);
    }
     ?>
  </body>
</html>
