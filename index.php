<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>instaclone</title>
  </head>
  <body>
    <ul>
      <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
      <li><a href="index2.php"><i class="fa fa-search" aria-hidden="true"></i></a></li>
      <li><a href="index3.php"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
      <li><a href="index4.php"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
      <li><a href="index5.php"><i class="fa fa-user-o" aria-hidden="true"></i></a></li>
    </ul>
    <div class="lgnreg">
      <a href="index-login.php"><span style="color:darkgray">L</span>ogin</a>
      <a href = "logout.php" title = "Logout">/<span style="color:darkgray">L</span>ogout</a>
    </div>
    <table>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <select name="sorteermenu">
          <option value="date_asc">datum oplopend</option>
          <option value="date_desc">datum aflopend</option>
        </select>
        <input type="submit" name="submit_sort" value="sorteren">
      </form>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="searchterm">
        <input type="submit" name="submit_search" value="zoeken">
      </form>

      <?php

      $dbc = mysqli_connect('localhost','root','','14511_database')  or die('Error connection to MySQL server.');

          $column = 'date';
          $sortorder = 'DESC';

          if (isset($_POST['submit_search'])) {
            $searchterm = mysqli_real_escape_string($dbc,trim($_POST['searchterm']));
            $searchterm = '%' . $searchterm .'%';
          } else {
            $searchterm = '%';
          }
          $column = 'date';
          $order = 'DESC';
          $query = "SELECT * FROM 14511_imageupload WHERE description LIKE '$searchterm' ";

          if(isset($_POST['submit_sort'])) {
            switch($_POST['sorteermenu']) {
              case 'date_asc': $column = 'date';
                                $order = 'ASC';
                                break;
              case 'date_desc': $column = 'date';
                                $order = 'DESC';
                                break;

            }
            $query.= " ORDER BY $column $order";
          }



          $result = mysqli_query($dbc, $query) or die('Error querying database');

         while ($row = mysqli_fetch_array($result)) {
            $target = $row['target'];
            $date = $row['date'];
            $account = $row['account'];
            $description = $row['description'];
            echo '<div class="pics">';
            echo '<img src="' . $target . '" /><br>';
            echo $date .'<br>';
            echo $account .'<br>';
            echo '<i class="fa fa-comment-o" aria-hidden="true"></i> ', $description , '<br>';
            echo '<i class="fa fa-heart" aria-hidden="true"></i> ';
            echo '</div>';
         }
         mysqli_close($dbc);
        ?>
     </table>
     <?php
        ob_start();
        session_start();

        if (isset($_SESSION['id'])) {

        }

        ?>
   </body>
</html>
