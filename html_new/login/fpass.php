<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	
	$stmt = $user->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		
		$message= "
				   Hello , $email
				   <br /><br />
				   We received a request to reset your password,  just click the following link to reset your password, Please ignore this mail if you have already changed your password.
				   <br /><br />
				   Click Following Link To Reset Your Password
				   <br /><br />
				   <a href='http://www.etddd.in/login/resetpass.php?id=$id&code=$code'><button>click here to reset your password</button> </a>
				   <br /><br />
				   Best Regards :)<br><br>
				   Web Team 
				   ETDDD-2018.<br>
				   Indian Institute of Technology (BHU)<br>
				   Varanasi. Pin- 221005<br>

				   Uttar Pradesh India
				   ";
		$subject = "Password Reset";
		
		$user->send_mail($email,$message,$subject);
		
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
			  	</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry!</strong> This email-id dosenot exists in our Database. 
			    </div>";
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Forgot Password</title>
    <!-- Bootstrap -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.0/semantic.min.css" />
    <link href="css/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body >
    
<div class="ui segment" style="padding-left:40px;padding-right:40px;  ">
		Hi!  <strong><?php echo "Guest!";?> </strong> 
<div style="float:right; margin-right: 30px; margin-top:-10px;"><a href="login.php" class="ui button aligned center red" style="padding:10px;" >LogIn! </a></div>
 
 <div class="ui divider">Status : Logged Out.
  </div>

<h4 class="ui top attached header">Forgot Password.
    </h4>
	

<div class="ui bottom attached segment">
	
	<div class="row"><div class="col-md-3"></div>
<div class="col-md-6">
      <form class="form-signin" method="post">
        
        
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
				Please enter your email address. You will receive a link to create a new password via email.!
				</div>  
                <?php
			}
			?>
        
        <input type="email" class="form-control"" placeholder="Email address" name="txtemail" required />

     	<hr />
        <button class="btn btn-danger btn-primary" type="submit" name="btn-submit">Generate new Password</button>
      </form>
      </div>
	<div class="col-md-3"></div>
      </div>
	</div>
	<br><br>
    </div> <!-- /container -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>