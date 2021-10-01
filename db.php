<?php
 $user = "root";
 $pass = "";
 $db_name = "straip";
 $host = "localhost";
 //$charset = "utf-8";

 try{
     $DB = new PDO("mysql:host=$host; dbname=$db_name", $user, $pass);
     //echo "pavyko";
 } catch (PDOException $e){
     print "Klaida!: " . $e->getMessage() . "<br/>";
     die();
 }

?>