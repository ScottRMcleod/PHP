<?php include "partials/libs.php";?>

<!DOCTYPE html>
<!--    
        Developed by Scott Mcleod      
        Version: 1.01
        Date Created: 13th June 2016
-->
<html lang="en" ng-app="smcleodtech">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{ DEVELOPER } { DESIGNER } { THINKER }</title>
  <!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="http://www.smcleodtech.com.au/css/bootstrap.min.css">
<link rel="stylesheet" href="http://www.smcleodtech.com.au/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" type="image/png" href="http://www.smcleodtech.com.au/Images/SMcleodTechnologiesLogo2.png">
<script src="http://www.smcleodtech.com.au/js/script.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body style="padding-top: 70px">
<div class="container" id="main">
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1">
  <span class="sr-only">Toggle navigation</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</button>
<a href='http://www.smcleodtech.com.au'>
  <img class='navbar-brand' src='http://www.smcleodtech.com.au/Old_Version2/Images/SMcleodTechnologiesLogo.png'></a></div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="topFixedNavbar1">
  <ul class="nav navbar-nav">
  <ul class="dropdown-menu" role="menu">
    <li><a id="SoftLink1" href="#software">Software Applications</a></li>
    <li><a href="#">Web Design</a></li>
    <li><a href="#">Web Application Development</a></li>
    <li class="divider"></li>
    <li><a href="#">Separated link</a></li>
    <li class="divider"></li>
    <li><a href="#">One more separated link</a></li>
  </ul>
  </li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
  <li><a href="#">Home</a></li>
  <li><a href="#">About</a></li>
  <li><a href="#contacts">Contact</a></li>
  <li><a href="http://www.smcleodtech.com.au/WordPress">Blog</a></li>
  <li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Work
    <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
      <li><a id="SoftLink2" href="#software">Software Applicatons</a></li>
      <li><a href="#">Web App Development</a></li>
      <li><a href="#">Web Design</a></li>
      <li class="divider"></li>
      <li><a href="#">Product Training</a></li>
    </ul>
   </li>
    <li><a href="#Login" data-toggle="modal" data-target="#myModal">Sign In</a></li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
    </nav>
    <div class="container">
  
  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade modal-blue" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-8 col-lg-6">
          <center><img src="http://www.smcleodtech.com.au/Old_Version2/Images/SMcleodTechnologiesLogo.png">
          </center>
          </div>
        </div>
          <div class="row">
            <div class="col-sm-8 col-lg-6">
             <form class="form-horizontal">
              <div class="form-group">
              <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
              </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">Submit</button>
    </div>
  </div>
</form>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8 col-lg-6" >
          Not a member? Join Now
        </div>
      </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
