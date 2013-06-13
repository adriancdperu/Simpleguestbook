<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <title>My Little Guest Book</title>
        <style type="text/css">
          .comment {
        		border-bottom: 1px solid #888;
        	}
        	.comment-delete {
        		text-align: right;
        	}
        	.comment-delete-form {
        		display: none;
        	}
        </style>
        <script type='text/javascript'>
        	function show_delete_comment(id) {
        		document.getElementById('comment-'+id+'-delete-form').style.display="block";
        		return false;
        	}
        </script>
</head>
<body>
 
<h3>Post A Comment:</h3>
<form action="post.php" method="post">
   <strong>Name:</strong><br/> <input type="text" name="name" /><br/>
    <strong>Email:</strong><br/> <input type="text" name="email" /><br/>
    <strong>Website:</strong><br/> <input type="text" name="website" /><br/>
    <strong>Message:</strong><br/> <textarea name="message" rows="5" cols="25"></textarea><br/>
    <strong>Password (for comment deletion):</strong><br/> <input type="password" name="password" /><br/>
    <input type="submit" value="Go">
</form>
 
<h3>Existing Comments:</h3>
 
<?php
require_once 'config.php';
$allPostsQuery = mysql_query("select * from comments order by `timestamp` DESC ");
if(mysql_num_rows($allPostsQuery) < 1) {
    echo "No comments were found!";
} else {
    while($comment = mysql_fetch_assoc($allPostsQuery)) {
?>
    	<div class='comment'>
        	<b>Name:</b> <?php echo $comment['name']; ?><br/>
        	<b>Email:</b> <?php echo $comment['email']; ?><br/>
        	<b>Website:</b> <?php echo $comment['website']; ?><br/>
        	<b>Message:</b> <?php echo $comment['message']; ?><br/>
        	<b>Posted at:</b> <?php echo date("Y-d-m H:i:s",$comment['timestamp']); ?><br/>
        	<div class='comment-delete'>
	       		<a href='#' onclick='return show_delete_comment(<?php echo $comment['id'] ?>)'>Delete This Comment</a>
	       		<form class='comment-delete-form' id='comment-<?php echo $comment['id'] ?>-delete-form' action='delete.php' method='post'>
	       			<input type='hidden' name='id' value='<?php echo $comment['id']; ?>'>
	       			Password: <input type='password' name='password'>
	       			<input type='submit' value='Delete'>
	       		</form>
	       	</div>
        </div>
<?php
    }
}
?>
</body>
</html>
