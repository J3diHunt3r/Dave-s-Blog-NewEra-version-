
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <title>Blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  

  <link rel="stylesheet" href="../style/Bootstrap-Stylesheet.css" />
  <link rel="stylesheet" href="style/main.css">
  <script language="JavaScript" type="text/javascript">
  function delpost(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'index.php?delpost=' + id;
	  }
  }
  </script>
</head>

<body>
<div class="jumbotron text-center" style="justified">
  <h1>NewEra Blog</h1>
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class>
  <?php include('admin/usermenu.php');?>
  </div>  
</nav>

<?php require('includes/config.php'); 

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./');
	exit;
}

?>
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
</head>
<body>

	<div class="container" style="margin-top:30px">

		<h1>Blog</h1>
		<hr />
		<p><a href="./">Blog Index</a></p>


		<?php	
			echo '<div>';
				echo '<h1>'.$row['postTitle'].'</h1>';
				echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
				echo '<p>'.$row['postCont'].'</p>';				
			echo '</div>';
		?>

	</div>


  <style>
	.fa {
	padding: 20px;
	font-size: 30px;
	width: 50px;
	text-align: center;
	text-decoration: none;
	margin: 5px 2px;
	}
</style>

	<div class="jumbotron text-center" style="margin-bottom:0">
  <p>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<a href="#" class="fa fa-facebook"></a>
	<a href="#" class="fa fa-instagram"></a>
	<a href="#" class="fa fa-twitter"></a>
	<a href="#" class="fa fa-youtube"></a>
  </p>
</div>

</body>
</html>