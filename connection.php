<?php
define("host","localhost");
define("duser","root");
define("dpass","");
define("ddb","project1");
$conn=mysqli_connect(host, duser, dpass, ddb);
if(!$conn){
    echo "Unable to connect to the database.";
}
?>