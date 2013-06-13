<?php
require_once 'config.php';
$fields = array("name", "website", "email", "message", "password");
$safe_values = array();
$isOkay = TRUE;
 
 
foreach ($fields as $field) {
    if (empty($_POST[$field])) {
        $isOkay = FALSE;
        break;
    }
    //create a safe version of the data, to prevent against sql injection attacks
    $safe_values[$field] = mysql_real_escape_string($_POST[$field]);
}
 
if ($isOkay) {
  //hash the password
	$safe_values["password"] = md5($_POST['password']);
    $now = time();
    if (mysql_query("insert into comments (	`name`,`website`,`email`,`message`,`key`,`timestamp`) values ('{$safe_values[name]}','{$safe_values[website]}','{$safe_values[email]}','{$safe_values[message]}','{$safe_values[password]}','{$now}')")) {
    	//successful insert, do the redirect
        header("Location: index.php");
        exit();
    } else {
       $error_message = "There was an error connecting to the database!";
    }
} else {
    $error_message = "One or more fields are empty!";
}

//if we got to this point then we didn't do the redirect, so $error_message 
// variable will be filled. The output has been moved to below the script
// This allows the redirect to work (previously it wouldn't work because the
// start of the document was already output to the browser, so you can't change
// the headers to do the redirect)
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <title>My Little Guest Book</title>
</head>
<body>
	<?php echo $error_message; ?>
</body>
</html>
