<?php
require_once 'config.php';
//delete the row with the given ID and the correct password:
mysql_query("delete from comments where `id` = '".mysql_real_escape_string($_POST['id'])."' and `key` = '".md5($_POST['password'])."'");
if (mysql_affected_rows() == 1) {
  //if the affected rows = 1 then the password was correct
	header("Location: index.php");
	exit();
}

//if we didn't redirect then it means the row didn't delete which means the password was probably wrong
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <title>My Little Guest Book</title>
</head>
<body>
	Could not delete post. Check the password is the one given when the post was created.
</body>
</html>
