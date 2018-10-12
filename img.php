<?php
include_once("function.php");

if($_GET["user"]){

$user=$_GET["user"];

$dir="data/user/".$user."/a.png";

echo imguuu($dir);

}

?>