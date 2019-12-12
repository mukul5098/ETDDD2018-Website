<?php
session_start();
require_once '../class.user.php'; 
require '../functions/escape.php';


 
$user_home = new USER();

if(!$user_home->is_logged_in())
{
   

    $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt_uploads = $user_home->runQuery("SELECT * FROM uploads WHERE user_id=:uid");
$stmt_uploads->execute(array(":uid"=>$_SESSION['userSession']));
$row2 = $stmt_uploads->fetch(PDO::FETCH_ASSOC);

if($row2['uploaded_flag']==0 && $row['userID']==$_SESSION['userSession']){
if(isset($_POST['submit'])){ 

        $user_id = escape(trim($_SESSION['userSession']));
        $email = escape(trim($_POST['email']));
        $author_name = escape(trim($_POST['author']));
        $country= escape(trim($_POST['country']));
        $title= escape(trim($_POST['title']));
         $abstract= escape(trim($_POST['abstract']));
            $uploaded_flag=1;

$user_home->insert_into_uploads_tbl($user_id,$email,$author_name,$country,$title,$abstract,$upload_url );
                            $username=ucwords($row['userName']);
                           $message = "                 
                        Hello {$username} ,
                        <br /><br />
                        Welcome to ETDDD 2018, IIT (BHU) Varanasi.<br/>
                        We have received your abstract  entitled :'  {$title} '. You will be informed via email, the status of your abstract.<br><br> You may also track the status of your abstract, by logging into our website. 
                        
                        <br /><br />
                        Thanks,<br><br>
                    Conference Desk ETDD 2018.<br>
 <a href='http://etddd.in'>www.etddd.in</a>


";
                        
                         $subject = "Abstract Received";


                            $user_home->send_mail($email,$message,$subject); 
                 $msg = "
                    <div class='alert alert-success'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Success!</strong>, Your abstract has been uploaded successfully! . 
                    </div>
                    ";


    /*$file=$_FILES['file'];
    $file_name = $file['name'];
    $file_temp =$file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_ext = explode('.',$file_name);
    $file_ext = strtolower(end($file_ext));

    $allowed = array('jpg','doc','pdf','docx');*/
       
    
}
}else{
    $msg="<div class='alert alert-warning'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>You have Already Submitted Your Paper.</strong> . If you want to submit again , please contact Admin.</div>";
}

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
    <title>Submit Paper/Abstract</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/ico" href="logo.ico"/>
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
                                        <img src="#" alt="" class="img-rounded" />
                                    </a>
                                    
                                </div>
                               
                                
                                
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
                        <span style="color: yellow;" id="menu-top" >Hi, <?php echo ucwords($row['userName']) ;?></span>
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
                    <h4 class="page-head-line">Abstract Submission Page</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        
                  
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
                          Author & Abstract Info.
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
                     <label for="author">Author</label>
                     <input type="text" class="form-control" id="author" name="author" placeholder="Enter Your Name" value="<?php echo $row['userName'];?>" />
                </div>
                </div>
            </div>




                <div class="form-group">
                <label for="email">Email</label>
                <input type="emal" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $row['userEmail'];?>" />
              </div>
               <div class="form-group">
              <label for="country">Country:</label> 
              <select class="form-control" name="country">
                  <option value="<?php echo $row['country'];?>"><?php echo $row['country'];?></option>
                  

              </select> </div> 
            <div class="form-group">
                <label for="title">Paper Title:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title of the paper" />
              </div>
            <div class="form-group">
                <label for="abstract">Abstract:</label>
                <textarea id="" name="abstract" class="form-control" rows="8" placeholder="Enter or Paste the Abstract text here..." required></textarea>  
              </div>
             <!--<div class="form-group">
                <label for="file" >Attach Research Paper:</label><br>
                <input type="file" id="exampleInputFile" class="ui button aligned center teal" name="file" >
                
              </div>-->
              <div class="checkbox">
                <label>
                  <input type="checkbox" /> I have read and agree to the terms and conditions. Further, I understand that if my paper is accepted for publication that I will be required to pay the appropriate article processing fee.
                </label>
              </div>
              <button type="submit" class="btn btn-success" id="submit" name="submit">Submit</button>
                                       <hr />
                                       
 </form>
        </div>


                            </div>
                            </div>
                    </div>

                    <div class="col-md-3">
        
                    </div>

            </div>


<!-- Submit Form Ends -->

<!--Icons   starts -->
                        
<!-- ICONS ENDS HERE -->




        </div><!-- Container Ends Here -->
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->




    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   &copy; All rights reserved. ETDDD-2018, IIT (BHU) Varanasi-221005 | By : <a href="http://www.etddd.in/" target="_blank">ETDDD-2018</a>
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
