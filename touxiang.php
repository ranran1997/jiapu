<html>
<head>
<meta charset="utf-8">
<title>头像上传</title>
</head>
<body>

<form action="api.php" method="post" enctype="multipart/form-data">

	<label for="file">请选择头像：</label>
	<input type="file" name="file" id="file"></br>

<br>帐号/User：</br>
        <input type="text" name="user" >
<br>密码/Pass：</br>
        <input type="text" name="pass" >
	 <input type="submit" name="t" value="上传">

</form>


</body>
</html>
