<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>FBZ</title>
  </head>
  <body>
  <div class="logo"><a href="index.php"><img src="logo.png" alt="logo"></a></div>
    <ul>
      <li><a href="index3.php">merch</a></li>
      <li><a href="index4.php">zombies</a></li>
      <li><a href="index2.php">music</a></li>
    </ul>
    <div id="login">
      <h3>Will you join the zombie army?</h3>
      <p>Sign up for more information about<br> the tours and join the zombie<br> army by signing up and supporting<br> The Flatbush Zombies.</p>
      <div class="an"></div>
        <div id="lgn">
        <a href="index-register.php" ><button class="jobut">Join</button></a>
        <form class="" action="" method="post">
          <label for="username">Username</label><br>
          <input type="text" name="username" id="username"><br>
          <label for="password">Password</label><br>
          <input type="password" name="password" id="password"><br>
          <button class = "lgn-button" id="blgn" type = "submit" name = "login">Login</button><br>
            <button class = "lgnout-button" id="lgnt" type = "submit" name = "logout">Logout</button>
        </form>
     </div>
    </div>
    <?php
       session_start();

       if (!isset($_SESSION['id'])) {
           if (isset($_SESSION['id']) && isset($_COOKIE['username'])) {
               $_SESSION['id'] = $_COOKIE['id'];
               $_SESSION['username'] = $_COOKIE['id'];
           }
       }

                if (isset($_POST['login']) && !empty($_POST['username'])
                   && !empty($_POST['password'])) {

                     $dbc = mysqli_connect('localhost','root','','14511_database')
                             or die('Error connection to MySQL server.');
                     $query = "SELECT username, password, id FROM 14511_proj WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'";
                     $result = mysqli_query($dbc, $query) or die('Error querying database');
                     $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
                     $username = $result[0]['username'];
                     $password = $result[0]['password'];
                     $id = $result[0]['id'];
                   if ($_POST['username'] == $username &&
                      $_POST['password'] == $password) {
                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username;

                            setcookie('id', $id, time() + (60 * 60 * 24 * 30));
                            setcookie('username', $username, time() + (60 * 60 * 24 * 30));

                      mysqli_close($dbc);
                   }else {
                       echo "<script type=\"text/javascript\">window.alert('password or username is wrong.');</script>";
                   }
                }
                if (isset($_POST['logout'])) {
                  if (isset($_SESSION['id'])) {
                    $_SESSION = array();
                    if (isset($_COOKIE[session_name()])) {
                      setcookie(session_name(),time() - 3600);
                    }
                      echo "<script type=\"text/javascript\">window.alert('U bent nu uitgelogd.');</script>";
                    session_destroy();
                  }
                  setcookie('id', time() - 3600);
                  setcookie('username', time() - 3600);
                }


    $dbc = mysqli_connect('localhost', 'root' , '', '14511_database');

    $results_per_page = 2;

    $query = "SELECT * FROM 14511_proj_admin";
    $result = mysqli_query($dbc,$query);
    $number_of_results = mysqli_num_rows($result);

    $number_of_pages = ceil($number_of_results/$results_per_page);

    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    $this_page_first_result = ($page-1)*$results_per_page;

    $query = "SELECT * FROM 14511_proj_admin LIMIT " . $this_page_first_result . ',' . $results_per_page;
    $result = mysqli_query($dbc, $query);

    while ($row = mysqli_fetch_array($result)) {
        $account = $row['account'];
        $target = $row['target'];
        $date = $row['date'];
        $description = $row['description'];
        echo '<div class="pics">';
        echo '<img src="' . $target . '" /><br>';
        echo '<p class="date-post">'. $date .'</p><br>';
        echo '<p class="desc-post-post">'. $description .'</p><br>';
        echo '<p class="name-post">'. $account .'</p><br>';
        echo '</div>';
    }

    for ($page=1;$page<=$number_of_pages;$page++) {
        echo '<a href="index.php?page=' . $page . '">' . $page . '</a>';
    }
             ?>
  </body>
</html>
