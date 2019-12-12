
<?php
session_start();
require_once '../class.user.php'; 
require '../functions/escape.php';


 
$user_home = new USER();

if(!$user_home->is_logged_in())
{
   

    $user_home->redirect('index.php');
}
$stmt = $user_home->runQuery("SELECT tbl_users.userName as ui, uploads.author_name,uploads.title as title,upload_url
FROM tbl_users
INNER JOIN uploads ON tbl_users.userID=uploads.user_id  WHERE tbl_users.userID=:userId");
$stmt->execute(array(":userId"=>$_SESSION['userSession']));
$rows = $stmt->fetchAll(PDO::FETCH_OBJ);
//$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
//$stmt->execute(array(":uid"=>$_SESSION['userSession']));
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
foreach($rows as $row){
  echo $row->ui.'&nbsp;&nbsp;&nbsp;&nbsp;'.$row->title.' '.$row->upload_url.' '."<a href='../user_panel/{$row->upload_url}'>his</a>";
  //echo "<a href='../user_panel/{$row->upload_url}'>his</a>";
}
//echo  $row['ui'] .' '. $row['title'].'<br>';
//}
?>

<br><br>
SELECT Customers.CustomerName, Orders.OrderID
FROM Customers
FULL OUTER JOIN Orders ON Customers.CustomerID = Orders.CustomerID
ORDER BY Customers.CustomerName; 


WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));

$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);


