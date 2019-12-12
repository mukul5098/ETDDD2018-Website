<?php
session_start();
require_once 'class.user.php';
require_once 'classes/Token.php';
require 'functions/escape.php';
require 'app/captcha_init.php';

$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('home.php');
}
$errors=[];
$captcha_error='';
if(isset($_POST['btn-login']))
{

	$response = $recaptcha->verify($_POST['g-recaptcha-response']);
if($response->isSuccess()){



	$email = escape(trim($_POST['txtemail']));
	$upass = escape(trim($_POST['txtupass']));
	 
    if( !empty($email) &&!empty($upass)  ){
   
   
    	if($user_login->login($email,$upass))
    	{ 
    		if(Token::check($_POST['token'])){
      
    				
      		$user_login->redirect('home.php');
  
    		

       		} else{
    		echo 'Token MisMatched';
  			}



       
    	}else{
    	echo "Invalid Password or Email Id. Please Login Again";
        $errors = $response->getErrorCodes();
        //session_destroy();
        foreach($errors as $error){
          ?>
           
    <div class='alert alert-success'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong><?php echo "Invalid Password or Email Id. Please Login Again";?></strong> 
      </div>
           <?php
        }
        }


         
  	}
    
  }else{
  	  if(!isset($_GET['g-recaptcha-response']))
    {

    	

    	$captcha_error= "<div class='alert alert-success'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Invalid Captcha! or Captcha not Clicked!</strong> 
      </div>";
 

	
    }	
  }
}
?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login ETDDD-2018</title>
  
  
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>

      <link rel="stylesheet" href="css/style.css">
<link rel="shortcut icon" type="image/ico" href="logo.ico"/>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <script src='https://www.google.com/recaptcha/api.js'></script> 
</head>

<body>


  <div class="login-wrap">

<div class="login-html-outer">

<?php 
echo $captcha_error;


		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-danger' ">
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
			</div>
            <?php
		}
		?>

		<?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-success' >
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Wrong Login Details!</strong> 
			</div>
            <?php
		}

   
		?>
</div>
	<div class="login-html">
	
		<h3 style="color:white;">Welcome to the ETDDD-2018.</h3><br/>
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked ><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="hidden" name="tab" class="sign-up" ><label for="tab-2" class="tab"></label>

		<div class="login-form">
		<form action="" method="post">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">Email Id</label>
					<input id="user" type="text" class="input" name="txtemail" placeholder="Your Registered Email.">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password" name="txtupass">
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>
				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				<div class="group">
				<p><div class="g-recaptcha" data-sitekey="6LcsPy0UAAAAAL8ldbAvK1ntH5EmlPkPO3psY18W"></div></p><br>
					<input type="submit" class="button" value="Sign In" name="btn-login" >
				</div>
				<div class="hr"></div>
				<div class="foot-lnk" style="color: white;">
					<a href="fpass.php"><span  style="color: white;">Forgot Password?</span> </a> or <a href="signup.php"> <span  style="color: white;">Register for ETDDD-2018</span></a> 
				</div>
			</div>
			</form>

		</div>
	</div>
</div>
  
 <!-- Latest compiled and minified JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>

