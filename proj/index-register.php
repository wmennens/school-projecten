<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>FBZ</title>
  </head>
  <body>
  <div class="logo"><a href="index.php"><img src="logo.png" alt="logo"></a></div>
    <h1>Joining the army!</h1>
    <form method="post" action="" class="fullin">
      <label for="name">Name</label>
      <input type="text" name="name" id="name"><br>
      <label for="secondname">Second name</label>
      <input type="text" name="secondname" id="secondname"><br>
      <label for="username">Username</label>
      <input type="text" name="username" id="username"><br>
      <label for="password">Password</label>
      <input type="password" name="password" id="password"><br>
      <label for="password">Password again</label>
      <input type="password" name="password2" id="password2"><br>
      <label for="email">Email</label>
      <input type="text" name="email" id="email"><br>
      <button type="submit" id="breg" name="submit_register" value="Register">Join</button>
    </form>

    <?php
    session_start();
    $dbc = mysqli_connect('localhost','root','','14511_database')
            or die('Error connection to MySQL server.');


        if (isset($_POST['submit_register']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['secondname']) && !empty($_POST['email']) && !empty($_POST['password2'])) {
            $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
            $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
            $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
            $secondname = mysqli_real_escape_string($dbc, trim($_POST['secondname']));
            $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
            $hashed_password = hash('sha512', $password);

            if ($password == $password2) {
                $query = "INSERT INTO 14511_proj (id,username,password,email,name,secondname,hashed_password)
                        VALUES (0,'".$username."','".$password."','".$email."','".$name."','".$secondname."','".$hashed_password."')";
                echo "<script type=\"text/javascript\">window.alert('Bedankt voor registtratie.');</script>";
                $result = mysqli_query($dbc, $query) or die('Error querying database');

            } else {
                echo "<script type=\"text/javascript\">window.alert('de passworden komen iet overeen.');</script>";;
            }

    }
    ?>
  </body>
</html>
