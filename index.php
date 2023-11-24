<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "CIH";


$cnx = new mysqli($servername,$username,$password);
if($cnx->connect_error){
    echo 'cnx failed';
}else{
    echo'connected ';
}


$creatDb = "CREATE DATABASE IF NOT EXISTS CIH" ;
$cnx->query($creatDb);





