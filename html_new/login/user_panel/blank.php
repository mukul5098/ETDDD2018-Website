<?php
session_start();
require_once '../class.user.php'; 


 
$user_home = new USER();

if(!$user_home->is_logged_in())
{
   

    $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row_main = $stmt->fetch(PDO::FETCH_ASSOC);


//$stmt_noti = $user_home->runQuery("SELECT * FROM notifications" );
//$stmt_noti->execute();
//$rows = $stmt_noti->fetch(PDO::FETCH_ASSOC);


$stmt_noti = $user_home->runQuery("SELECT * 
FROM notifications ");

$stmt_noti->execute();
$rows = $stmt_noti->fetchAll(PDO::FETCH_OBJ);
//$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
//$stmt->execute(array(":uid"=>$_SESSION['userSession']));
//$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt_abstract = $user_home->runQuery("SELECT tbl_users.userName as ui,uploads.id as id, uploads.author_name,uploads.title as title,status,uploads.upload_url as url
FROM tbl_users
INNER JOIN uploads ON tbl_users.userID=uploads.user_id  WHERE tbl_users.userID=:userId");
$stmt_abstract->execute(array(":userId"=>$_SESSION['userSession']));
$rows2 = $stmt_abstract->fetchAll(PDO::FETCH_OBJ);




$stmt_payU = $user_home->runQuery("SELECT transactions_payumoney.complete, tbl_users.country as country, tbl_users.userName as ui, transactions_payumoney.payment_id as pay_id ,  transactions_payumoney.subtotal as subtotal,registration_amount ,quantity1,acc_amount,quantity2
FROM tbl_users
LEFT  JOIN transactions_payumoney ON tbl_users.userID=transactions_payumoney.user_id  WHERE tbl_users.userID=:userId AND  transactions_payumoney.complete=1 LIMIT 1");
$stmt_payU->execute(array(":userId"=>$_SESSION['userSession']));
$rows4 = $stmt_payU->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>User dashBoard</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/ico" href="logo.ico"/>
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
     <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.0/semantic.min.css" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Email: </strong>etddd@iitbhu.ac.in
                    &nbsp;&nbsp;
                    
                   <div style="float:right; margin-right: 30px; margin-top:-10px;"><a href="../logout.php" class="ui button aligned center purple" style="padding:10px;" >LogOut! </a></div> 
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../home.html" style="color:white;">

                   <img src="assets/img/logo.png" />
                  
                </a>

            </div>

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                            </a>
                         
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
           <span style="color: yellow;" id="menu-top" >Hi, <?php echo ucwords($row_main['userName']) ;?></span>
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a  href="blank.php">Dashboard</a></li>
                            
                             
                          

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
				<marquee > "Online abstract submission is OPEN now! Online Payment facility will be available SHORTLY! </marquee> 
                    <h4 class="page-head-line">User Page</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                       
                    </div>
                </div>

            </div>








<!--Icons   starts -->
<div class="row">
 
 <div class="col-md-2 col-sm-2 col-xs-6">
            <div class="dashboard-div-wrapper">
             <p><a href="#noti" ><i  class="fa fa-bell-o dashboard-div-icon" ></i>
               <span  class="ui button aligned center red">Conference Notifications</span></a></p>
            </div>                       
</div>

 <div class="col-md-2 col-sm-2 col-xs-6">
            <div class="dashboard-div-wrapper">
           <p><a href="submit_paper.php"  > <i  class="fa fa-upload dashboard-div-icon" ></i>
                 <span class="ui button aligned center green">Submit Paper(s) </span></a></p>
            </div>    
</div>

<div class="col-md-2 col-sm-2 col-xs-6">
            <div class="dashboard-div-wrapper">
              <p><a href="#abstract" ><i  class="fa fa-file-text-o dashboard-div-icon" ></i>
              <span class="ui button aligned center yellow">Abstract/Paper Details</span></a></p>
            </div> 
  
                           
</div>

<div class="col-md-2 col-sm-2 col-xs-6">
                    
                      <?php 

if($row_main['isAdmin']==0 && $row_main['country']=="India" ){
    ?>
<div class="dashboard-div-wrapper ">
                      <?php echo '<!---a href="../payUpayments/PayUMoney_form.php" ---> <i  class="fa fa-rupee dashboard-div-icon" ></i><p>
<span class="ui button aligned center teal" > Pay via PayUMoney (Will be available soon) </span></a>';

 }else{
    ?>
    <div class="dashboard-div-wrapper ">
                        <i  class="fa fa-dollar dashboard-div-icon" ></i><p>
<?php echo '<a href="../paypalpayments/index.php" class="ui button aligned center teal"  > Register via (PayPal)</a>';
} ?></p>
                       </div> 
  
                           
</div>


<div class="col-md-2 col-sm-2 col-xs-6">
            <div class="dashboard-div-wrapper">
            <p><a href="#noti"  ><i  class="fa fa-money dashboard-div-icon" ></i>
               <span class="ui button aligned center default"> Payment Details</span></a></p>
            </div>                       
</div>


   </div>                      
<!-- ICONS ENDS HERE -->
<!-- Notifications Table-->

<div class="row" >  <div class="col-md-3" ><div class="subheading" >Notifications</div></div>
</div> 
<div class="row" id="noti">
  <div class="col-md-2"></div>

                <div class="col-md-8">
                     <!--    Context Classes  -->
                    <div class="panel panel-primary">
                       
                        <div class="panel-heading">
                         </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="text-align: center;">Message(s) from Conference Desk</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sno=0;
                                    foreach($rows as $row){
                                        $sno++;
                                        echo '<tr>';
                                        echo '<td>'.$sno.'</td>';
  echo "<td>{$row->message}</td> ";
  echo "</tr>";
}
     ?>                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--  end  Context Classes  -->
                </div>


</div>

<!-- notification ends Here -->

<hr>





<!-- abstract Details Ends here -->
<hr>
<!-- Accomodation details -->
<div class="row" >  <div class="col-md-3" ><div class="subheading" >Abstract Details:</div></div>
</div> 
<div class="row" id="abstract">
  <div class="col-md-2"></div>

                <div class="col-md-8">
                     <!--    Context Classes  -->
                    <div class="panel panel-danger">
                       
                        <div class="panel-heading">
                        
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <?php  if(Count($rows2)>0){
                                   
                                    ?>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            
                                            <th style="text-align: center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sno=0;

                                   foreach($rows2 as $row){
                                    $sno++;
                                    echo '<tr>';
                                    echo "<td>{$sno}</td>";
                                    echo "<td>{$row->title}</td>";
  echo "<td style='text-align: center'>{$row->status}</td>";
  //echo "<a href='../user_panel/{$row->upload_url}'>his</a>";
  echo '</tr>';
  }
}else{
    echo 'No Abstract Uploaded Yet!.';
  }

     ?>                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--  end  Context Classes  -->
                </div>


</div>
<hr>
<!--Payment Details for Registration -->
<div class="row" >  <div class="col-md-3" ><div class="subheading" >Payment  Details:</div></div>
</div> 
<div class="row" id="abstract">
  <div class="col-md-2"></div>

                <div class="col-md-8">
                     <!--    Context Classes  -->
                    <div class="panel panel-primary">
                       
                        <div class="panel-heading">
                         
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                      <?php  
                                   
                                    ?>
                                        <tr>
                                            <th>#</th>
                                            <th>Payment Id</th>
                                            <th>Ticket_Amount</th>
                                            <th>No_of_tickets</th>
                                            <th>Total_Ticket_Amount</th>
                                            <th>Acc._Type</th>
                                            <th>No._of_Occupants</th>
                                            <th>Acc._Amoun </th>
                                            
                                             <th>Total_Acco_amount</th>   


                                            <th ><span style="color:red;">Overall_Total_Amount</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sno=0;
 
if($row_main['country']=="India"){
if(Count($rows4)>0){

    foreach($rows4 as $row){

                                        $sno++;

                                        echo '<tr>';
                                        
                                        echo '<td>'.$sno.'</td>';
  echo "<td>{$row->pay_id}</td>";


    echo "<td>{$row->registration_amount }</td>";
    echo "<td>{$row->quantity1}</td>";
        echo "<td>{$row->quantity1} X {$row->registration_amount }</td>";

         if($row->acc_amount==100){
            echo"<td>Normal</td>";
        }elseif($row->acc_amount==200){
             echo"<td>Normal</td>";
         }elseif($row->acc_amount==300){
             echo"<td>Hostel</td>";
         }else{
            echo"<td>Not Intrested</td>";
         }
     echo "<td>{$row->quantity2}</td>";
     echo "<td>{$row->acc_amount}</td>";
   echo "<td>{$row->quantity2} X {$row->acc_amount }</td>";
  echo "<td><span style='color:red;'>{$row->subtotal}</span></td> ";
}
}else{
echo 'You have not made any payment,Please <a href="../payUpayments/PayUMoney_form.php">click here</a> to Pay.';
}

}
  echo "</tr>";



     ?>                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--  end  Context Classes  -->
                </div>



</div>

<!-- Payment Deatils Ends -->
<hr>

<!--accommodation details ends -->

        </div><!-- Container Ends Here -->
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->




    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; All rights reserved. ETDDD-2018, IIT (BHU) Varanasi-221005 | Developed and Maintained by <a href="http://www.etddd.in/" target="_blank">Team ETDDD 2018 </a> 
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
