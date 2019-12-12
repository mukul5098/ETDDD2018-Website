<?php
session_start();
require_once 'class.user.php'; 


 
$user_home = new USER();

if(!$user_home->is_logged_in())
{
   

	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($row['isAdmin']==1 && $_SESSION['userSession']==1){

$user_home->redirect('admin_panel/blank.php');

}else{
$user_home->redirect('user_panel/blank.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	 <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.0/semantic.min.css" />
	 <!-- scripts -->
   
</head>
<body>
<div class="ui segment" style="padding-left:40px;padding-right:40px;  ">
Hi!  <strong><?php echo ucwords(strtolower($row['userName']));?> </strong> 
<div style="float:right; margin-right: 30px; margin-top:-10px;"><a href="logout.php" class="ui button aligned center red" style="padding:10px;" >LogOut! </a></div>
 
 <div class="ui divider">Status : Logged in.
  </div>

<h4 class="ui top attached header">Register.
    </h4>
    <div class="ui bottom attached segment">
	Please click the appropriate button to proceed to payment gateway (for Registration).
	
	<br><br>

	<span>1. For Indian Users  <a href="PayUGateway.php" class="ui button aligned center teal"  style="margin-left: 25px;"> Click to Register </a></span> 
	<br><br>
	<span >2 . For International  Users  <a href="paypalpayments/index.php" class="ui button aligned center green" style="margin-left: 25px;"> Click to Register </a></span>

    </div>
<br><br>
</body>
</html>