<?php
header("content-type:text/html;charset=utf-8");

//获取目录文件列表
function searchDir($path,&$data){
if(is_dir($path)){
$dp=dir($path);
while($file=$dp->read()){
if($file!='.'&& $file!='..'){
searchDir($path.'/'.$file,$data);
}
}
$dp->close();
}
if(is_file($path)){
$data[]=$path;
}
}


function getDir($dir){
$data=array();
searchDir($dir,$data);
return   $data;
}




//获取文件列表最大值
function posv($dir){

$array=getDir($dir);

$data=count($array);

for($i=0;$i<$data;$i++){

$v=explode('/',$array[$i]);

$vvv=explode('.',$v[1]);

$arr[$i]=$vvv[0];

}

$pos=@array_search(max($arr),$arr);

return $arr[$pos];

}



function yy($file){

if (file_exists($file)) {
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename='.basename($file));
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Pragma: public');
  header('Content-Length: ' . filesize($file));
  ob_clean();
  flush();
  readfile($file);
  exit;
}

}



//文件上传
function filev($file,$dir){

$posv=posv($dir);

$posv=$posv+1;

$temp = explode(".",$file["name"]);

$extension = end($temp);

	echo "文件名： " . $file["name"] . "<br>";
	echo "类型： " . $file["type"] . "<br>";
	echo "大小:：" . ($file["size"] / 1024) . " kB<br>";
	//echo "文件临时存储的位置: " . $file["tmp_name"];

$name=$posv.'.'.$extension;

if($extension!="php"){

if(move_uploaded_file($file["tmp_name"],$dir."/".$name))
{

echo "状态：成功<br>";
echo '你是本站第 <font color="#FF0000">'.$posv."</font> 个文件上传者<br>";
echo '直链：<font color="#11B599">'.HOST."up.php?f=".$name.'</font>';

}else{

echo "状态：失败";

}
}else{

echo "状态：失败<br>";
echo "不支持上传此文件";

}

}





//图片输出
function imguuu($dir){

$fileres = file_get_contents($dir);
header('Content-type: image/png');

return $fileres;

}





//登录
function login($user,$pass){

$file='data/user/'.$user.'/data.txt';

if($user==null||$pass==null){

return "请把信息写完整";

}

if(@file_exists($file)!="true"){

return "用户不存在";

}

$data=@file_get_contents($file);

if($data==null){

return "未知错误";

}

$data1=explode("①",$data);

if($data1[0]!=$user||$data1[1]!=$pass){

return "帐号或密码错误";

}

return "登录成功";

}




//注册
function register($user,$pass,$qq,$name){

$file='data/user/'.$user.'/data.txt';
$file1='data/user/'.$user;

if($user==null||$pass==null||$qq==null||$name==null){

return "请把信息写完整";

}

if(@file_exists($file)){

return "已有用户存在";

}

if(@mkdir($file1)!="true"){

return "未知错误";

}

$date=date("Y-m-d H:i:s");

$data=$user.'①'.$pass.'①'.$name.'①'.$qq.'①'.$date;

if(@file_put_contents($file,$data)==null){

return "未知错误01";

}

return "注册成功";

}




//用户信息
function userinfo($user){

$file='data/user/'.$user.'/data.txt';

if($user==null){

return "请把信息写完整";

}

if(@file_exists($file)!="true"){

return "要查询用户不存在";

}

$data=@file_get_contents($file);

if($data==null){

return "未知错误";

}

$data1=explode("①",$data);

$file19='data/user/'.$user.'/a.png';

if(@file_exists($file19)){

$img="img.php?user=".$data1[0];

}else{

$img='http://q2.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$data1[3].'&spec=100';

}

return "①".$data1[0]."①②".$data1[2]."②③".$data1[3]."③④".$img."④⑤".$data1[4]."⑤";

}




//密码修改
function revisepass($user,$pass,$pass1){

$file='data/user/'.$user.'/data.txt';

if($user==null||$pass==null||$pass1==null){

return "请把信息写完整";

}

if(@file_exists($file)!="true"){

return "要修改的用户不存在";

}

$data=@file_get_contents($file);

if($data==null){

return "未知错误";

}

$data1=explode("①",$data);

if($data1[0]!=$user||$data1[1]!=$pass){

return "要修改帐号或旧密码错误";

}

$p=$data1[0].'①'.$pass1.'①'.$data1[2].'①'.$data1[3].'①'.$data1[4];

if(@file_put_contents($file,$p)==null){

return "未知错误01";

}

return "修改成功";

}




//头像上传
function upimg($file,$user,$pass){

if($file==null||$user==null||$pass==null){

return "请把信息写完整";

}

if(@login($user,$pass)!="登录成功"){

return "帐号或密码不对";

}

$file1='data/user/'.$user.'/data.txt';
$file2='data/user/'.$user.'/a.png';

if(@file_exists($file1)!="true"){

return "还没注册用户";

}

if(!move_uploaded_file($file['tmp_name'],$file2)){ 

return "文件上传错误";

}

return "上传头像成功";

}

?>
