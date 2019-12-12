<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$statusY = "Y";
	$statusN = "N";
	
	$stmt = $user->runQuery("SELECT userID,userStatus FROM tbl_users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
	$stmt->execute(array(":uID"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	if($stmt->rowCount() > 0)
	{



		if($row['userStatus']==$statusN)
		{
			$stmt = $user->runQuery("UPDATE tbl_users SET userStatus=:status WHERE userID=:uID");
			$stmt->bindparam(":status",$statusY);
			$stmt->bindparam(":uID",$id);
			$stmt->execute();	
			
			$msg = "
		           <div class='alert alert-success'>
				   <button class='close' data-dismiss='alert'>&times;</button>
					  <strong>WoW !</strong>  Your Account is Successfully Activated. Click here to  <a href='index.php'>Login</a>
			       </div>
			       ";	
		}
		else
		{
			$msg = "
		           <div class='alert alert-info'>
				   
					  <strong>sorry !</strong>  Your Account is already Activated : <a href='index.php'>Login here</a>
			       </div>
			       ";
		}
	}
	else
	{
		$msg = "
		       <div class='alert alert-warning'>
			   
			   <strong>sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
			   </div>
			   ";
	}	
}

?>
<!DOCTYPE>
<html>
  <head>
    <title>Confirm Registration</title>
    <!-- Bootstrap -->

   
      <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400" rel="stylesheet">
      <link rel="stylesheet" href="css/style.css">
<link rel="shortcut icon" type="image/ico" href="logo.ico"/>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.0/semantic.min.css" />
   <link href="assets/styles.css" rel="stylesheet" media="screen">
 
  </head>
  <body >
    <div class="container">

<div class="ui segment"><p>Hi, <?php echo $user->userName;?>

  <div class="ui divider">
  </div>

<h4 class="ui top attached header">Confirmation:
    </h4>
    <div class="ui bottom attached segment">
    <p>
      <div class="row">
      	<div class="col-md-3"></div>
      	<div class="col-md-6">
      		
      		<?php if(isset($msg)) { echo $msg; } ?>
      	</div>
      	<div class="col-md-3"></div>
      </div>
       
      </p>
</div>


    
		
    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>