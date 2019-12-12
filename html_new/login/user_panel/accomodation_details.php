
<?php
session_start();
require_once '../class.user.php'; 
require '../functions/escape.php';


 
$user_home = new USER();

if(!$user_home->is_logged_in())
{
   

    $user_home->redirect('index.php');
}
$stmt = $user_home->runQuery("SELECT tbl_users.userName as ui, notifications.message as msg
FROM tbl_users
INNER JOIN notifications ON tbl_users.userID=notifications.user_id  WHERE tbl_users.userID=:userId");
$stmt->execute(array(":userId"=>$_SESSION['userSession']));
//$rows = $stmt->fetchAll(PDO::FETCH_OBJ);
//$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
//$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
	//foreach($rows as $row){
	 // echo $row->ui.'&nbsp;&nbsp;&nbsp;&nbsp;'.$row->msg.' ';
	  //echo "<a href='../user_panel/{$row->upload_url}'>his</a>";
	//}
//echo  $row['ui'] .' '. $row['title'].'<br>';
//}
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
    <title>Free Responsive Admin Theme - ZONTAL</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
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
                    <strong>Email: </strong>info@yourdomain.com
                    &nbsp;&nbsp;
                    <strong>Support: </strong>+90-897-678-44 &nbsp;&nbsp;
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
                <a class="navbar-brand" href="index.html">

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
                            <div class="dropdown-menu dropdown-settings">
                                <div class="media">
                                    <a class="media-left" href="#">
                                        <img src="assets/img/64-64.jpg" alt="" class="img-rounded" />
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">Jhon Deo Alex </h4>
                                        <h5>Developer  Designer</h5>

                                    </div>
                                </div>
                                <hr />
                                <h5><strong>Personal Bio: </strong></h5>
                                Anim pariatur cliche reprehen derit.
                                <hr />
                                <a href="#" class="btn btn-info btn-sm">Full Profile</a>&nbsp; <a href="login.html" class="btn btn-danger btn-sm">Logout</a>

                            </div>
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
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a  href="index.html">Dashboard</a></li>
                            <li><a href="ui.html">UI Elements</a></li>
                            <li><a href="table.html">Data Tables</a></li>
                            <li><a href="forms.html">Forms</a></li>
                             <li><a href="login.html">Login Page</a></li>
                             
                            <li><a class="menu-top-active" href="blank.html">Blank Page</a></li>

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
                    <h4 class="page-head-line">Book Accomodation:</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        This is blank page for which you can customize for your project. 
                        Use this admin template 100% free to use for personal and commercial use which is crafted by 
                        <br />
                        <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap.com</a> . For more free templates and snippets keep looking <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap.com</a> . Hope you will like our work
                  
                    </div>
                </div>

            </div>













<!-- Submit Form here -->
 <div class="row">
                
                
                    <div class="col-md-3"></div>   
                    <div class="col-md-6"><?php if(isset($msg)) echo $msg; ?>         
                    </div>
                    <div class="col-md-3"></div>
</div>

            <div class="row">
                
                <div class="col-md-3"></div>

                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Accomodation Details:
                        </div>
                        <div class="panel-body">

<!-- form  start here .upload code -->

<form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-3">
                 <div class="form-group">
                      <label for="salutation" >Salutation:</label> 
                      <select   class="form-control">
                          <option value="Dr">Dr</option>
                          <option value="Mr">Mr</option>
                          <option value="Mrs">Mrs</option>
                          <option value="Miss">Miss</option>
                          <option value="Ms">Ms</option>
                          <option value="Professor">Professor</option>
                      </select>
                  </div> 
              </div>
            <div class="col-md-9">                  
                <div class="form-group">
                     <label for="author">Name</label>
                     <input type="text" class="form-control" id="author" name="author" placeholder="Enter Your Name" />
                </div>
                </div>
            </div>




               
               <div class="form-group">
              <label for="country">Type of Accomodation :</label> 
              <select class="form-control" name="country">
                  <option value="Single Room ">Single Room </option>
                  <option value="Double Room">Double Room</option>
                  <option value="Hostel Room">Hostel Room</option>
                  <option value="Near Ganga Ghat">Near Ganga Ghat</option>

              </select> </div>

               <div class="form-group">
              <label for="country">No. of Days :</label> 
              <select class="form-control" name="country">
                  <option value="1 ">1 </option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>

              </select> </div> 

               <div class="form-group">
              <label for="country">No. of Members :</label> 
              <select class="form-control" name="country">
                  <option value="1">1 </option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>

              </select> </div> 
            
            
              <div class="checkbox">
                <label>
                  <input type="checkbox" /> I have read and agree to the terms and conditions. Further, I understand that if my paper is accepted for publication that I will be required to pay the appropriate article processing fee.
                </label>
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
                                       <hr />
                                       

        </div>
</form>
                            </div>
                            </div>
                    </div>

                    <div class="col-md-3">
        
                    </div>

            </div>


<!-- Submit Form Ends -->

<!--Icons   starts -->
<div class="row">
<div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="dashboard-div-wrapper ">
                        <i  class="fa fa-rupee dashboard-div-icon" ></i>
                     <p> <?php 

if($row['isAdmin']==0 && $row['country']=="India" ){

echo '<a href="PayUGateway.php" class="ui button aligned center teal" > Click to Register </a>';

}else{
echo '<a href="PayUGateway.php" class="ui button aligned center teal"  > Click to Register PP</a>';
} ?></p>
                       </div> 
  
                           
</div>

 <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="dashboard-div-wrapper">
            <i  class="fa fa-upload dashboard-div-icon" ></i>
                 <p><a href="PayUGateway.php" class="ui button aligned center green" >Submit  Paper </a></p>
            </div>    
</div>

<div class="col-md-3 col-sm-3 col-xs-6">
            <div class="dashboard-div-wrapper">
            <i  class="fa fa-cogs dashboard-div-icon" ></i>
                <p><a href="PayUGateway.php" class="ui button aligned center yellow">What is Coming?</a></p>
            </div> 
  
                           
</div>

 <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="dashboard-div-wrapper">
            <i  class="fa fa-bell-o dashboard-div-icon" ></i>
                <p><a href="PayUGateway.php" class="ui button aligned center red" >Notifications</a></p>
            </div>                       
</div>

   </div>                        
<!-- ICONS ENDS HERE -->




        </div><!-- Container Ends Here -->
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->




    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2017 YourCompany | Developed By : <a href="http://www.Area73.in/" target="_blank">Area73</a>
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