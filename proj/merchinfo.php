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
<?php
session_start();

$dbc = mysqli_connect('localhost','root','','14511_database')  or die('Error connection to MySQL server.');
$query = "SELECT * FROM 14511_proj_merch";
$result = mysqli_query($dbc, $query) or die('Error querying database');

while ($row = mysqli_fetch_array($result)) {
    $front = $row['front'];
    $price = $row['prce'];
    $description = $row['description'];
    echo '<div class="merch-pics">';
    echo '<img src="' . $front . '" /><br>';
    echo '<p class="price">'. $price .'</p><br>';
    echo '<p class="desc-merch">'. $description .'</p><br>';
    echo '</div>';
}
?>
</body>
</html>
