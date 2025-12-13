<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garden";
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql="inseret into utilisateurs(username,password,dateInscription)
values ('ilham','ilham1123','4/4/2025')";
if(mysqli_query($con,$sql)){
    echo "good job"
}
else{
    echo "erreur :" .$con->erreur ;
}

?>