<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if(!$user->is_logged_in())
{
	$user->redirect('login.php');
}

if($user->is_logged_in()!="")
{
	$user->logout();	
	$user->redirect('login.php');
}
?>