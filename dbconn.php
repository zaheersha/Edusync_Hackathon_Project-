<?php

$db = mysqli_connect("localhost","root","","hackathon");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>