<?php

header('location: login.php');
//require 'src/start.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
	if($user->member):
					function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "optional";                 
		$mail->Host       = "smtp.mailtrap.io";      
		$mail->Port       = 25;             
		$mail->AddAddress($email);
		$mail->Username="b799c2c3076643";  
		$mail->Password="a92e6ba68d1cf4";            
		$mail->SetFrom('rainaermanmeet@gmail.com','Coding Cage');
		$mail->AddReplyTo("rainaermanmeet@gmail.com","Coding Cage");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}
$email= $user->email;
$message='You Have been Registred now';
$subject = 'Registered';
	send_mail($email,$message,$subject)	

	?>
<p>You are a mmeber</p>
	<?php else: ?>
<p>You are not a member .<a href="member/payment.php">Become Member</a></p>
<div class="payment-container">
		<h2 class="header">Pay for Conference	
</h2>
<form action="member/payment.php" method="post">
	<label for="product">Product:
	<input type="text" name="product">

	</label><br>
	
<label for="price">Price:
	<input type="text" name="price">

	</label><br>
<input type="submit" class="submit" value="Pay">



</form>
<?php endif; ?>
</body>
</html>