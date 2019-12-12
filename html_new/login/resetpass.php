


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
	
	$stmt = $user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];
			
			if($cpass!==$pass)
			{
				$msg = "
						<strong>Sorry!</strong>  Password Doesn't match. 
						";
			}
			else
			{
				$password = md5($cpass);
				$stmt = $user->runQuery("UPDATE tbl_users SET userPass=:upass WHERE userID=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['userID']));
				
				$msg = "
						Password Changed. You will be redirected to login Page after few seconds.
						";
				header("refresh:5;login.php");
			}
		}	
	}
	else
	{
		$msg = "
				
				No Account Found, Try again
				";
				
	}
	
	
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Password Reset</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.0/semantic.min.css" />
   <link href="css/styles.css" rel="stylesheet" >
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body >

<div class="ui segment" style="padding-left:40px;padding-right:40px;  ">
		Hi!  <strong><?php echo ucfirst(strtolower($rows['userName']));?> </strong> 
<div style="float:right; margin-right: 30px; margin-top:-10px;"><a href="login.php" class="ui button aligned center red" style="padding:10px;" >LogIn! </a></div>
 
 <div class="ui divider">Status : Logged Out.
  </div>

<h4 class="ui top attached header"> You are here to reset your forgetton password.
    </h4>
	

<div class="ui bottom attached segment">

		

<div class="row"><div class="col-md-3"></div>
<div class="col-md-6">

        <form class="form-signin" method="post">
        <h3 class="form-signin-heading">Password Reset.</h3><hr />
        <?php
        if(isset($msg))
		{
			?>
				<div class='alert alert-danger' style="width: 50%;">
						<button class='close' data-dismiss='alert'>&times;</button>
						<?php echo $msg;?>
						</div>
		<?php
		}
		?>
		<div class="row">
			
			<div class="col-md-6"><p><input type="password" class="form-control" placeholder="New Password" name="pass" required /></p>
        <p><input type="password" class="form-control" placeholder="Confirm New Password" name="confirm-pass" required /></p></div>
        <div class="col-md-6"><p>* should be between 6 - 20 characters</p></div>
		</div>
        
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Reset Your Password</button>
        
      </div>
	<div class="col-md-3"></div>
      </div>
	</div>
	<br><br>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>