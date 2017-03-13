<?php
ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
 $color = "#FFFFFF";
 $Btext = "Error";
    if($userRow['download'] > 0) {
        $color = '#4CAF50';
        $Btext = 'Download';
    } else {
        $color = '#DC143C';
        $Btext = 'Koop nu!';
    } 
?> 
<html>
<head>
<title>MinetopiaATM Premium</title>
<style>
.button {
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}
</style>
</head>
<body>
<center><button type="button" style="background-color: <?php echo $color; ?>" class="button" onclick=""><?php echo $Btext; ?></button></center>
</body>
</html>