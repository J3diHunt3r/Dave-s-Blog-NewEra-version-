
<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['delpost'])){ 

	$stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
	$stmt->execute(array(':postID' => $_GET['delpost']));

	header('Location: index.php?action=deleted');
	exit;
} 

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="style/Bootstrap-Stylesheet.css" />
  <link rel="stylesheet" href="../style/main.css">
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

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>NewEra</h1>
  <p>By Carl Haricombe</p> 
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

  <div class>
  <?php include('menu.php');?>
  </div>  
</nav>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-4">
      <h2>Creator</h2>
      <h5>Photo of me:</h5>
      <div>
	  <img src="../Images/CarlHaricombe.jpg" alt="Image of Carl Haricombe" width="200" height="=200">
	  </div>
      <p>Carl Haricombe, the founder and editor of New Era a bootstrap edit of Dave's Blog.</p>
      <h3>Our Pages</h3>
      <p>Links are as above</p>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#index">HomePage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../" target="_blank">Blog Posts</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
      <h2>Our Blogs</h2>
      <h5>Blog Table, March 03, 2021</h5>
      <div>
	  <table>
      
	<tr>
		<th>Title</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	<?php
		try {

			$stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['postTitle'].'</td>';
				echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
				?>

				<td>
					<a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> | 
					<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
				</td>
				
				<?php 
				echo '</tr>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</table>
	<p><a href='add-post.php'>Add Post</a></p>
	  
	  </div>
      <p>Meta Data</p>
	  <p>We love allowing admin input to our blog and not just Dave's, so we have given admin freedom to post what they feel is relevent in today's day and age that is tech related.</p>
      <br>
      <h2>Why Dave?</h2>
      <h5>Edited, March 03, 2021</h5>
      <div>
	  	<img src="../Images/DavesBlog.png" alt="Image of original Dave's Blog" width="500" height="=200">
	  </div>
      <p>This is an assessment for Web Application Development, we had to adjust an already created website by adding bootstrap css elements to make Dave's Blog our own. As you can see I used Bootstrap 4. Users can still login if their information is saved in the database.</p>
    </div>
  </div>
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
