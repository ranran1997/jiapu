;<?php
include_once("function.php");

if($_POST[t]){

switch($_POST[t]){

case "登录":

die(login($_POST["user"],$_POST["pass"]));

break;

case "注册":

die(register($_POST["user"],$_POST["pass"],$_POST["qq"],$_POST["name"]));

break;

case "查询":

die(userinfo($_POST["user"]));p

break;

case "修改";

die(revisepass($_POST["user"],$_POST["pass"],$_POST["pass1"]));

break;

case "上传":

die(upimg($_FILES["file"],$_POST["user"],$_POST["pass"]));

break;

default:

echo "未调用接口";

}
}else{
echo "看什么看，这是接口文件  又不是你家的老母猪。";
}

?>
