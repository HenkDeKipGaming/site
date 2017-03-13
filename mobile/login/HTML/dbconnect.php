<?php

 // this will avoid mysql_connect() deprecation error, 
 error_reporting( ~E_ALL & ~E_DEPRECATED &  ~E_NOTICE );
 // I strongly suggest you to use PDO or MySQLi.
 
 define('DBHOST', '127.0.0.1');
 define('DBUSER', 'root');
 define('DBPASS', '27Cu9Wd3EadF');
 define('DBNAME', 'mtwebsite');
 
 $conn = mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysql_select_db(DBNAME);
 
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysql_error());
 }