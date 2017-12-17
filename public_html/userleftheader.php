<?php
include 'header.php';
if(!isset($_SESSION["uid"]))
{
	header("location:login.php");
}
?>
<!DOCTYPE >
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laundry Bucket | </title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/userleftheader.css">
    <link rel="stylesheet" href="assets/bootstrap-table.min.css">
    

         <script src="assets/jquery/jquery.min.js"></script>
            <script src="assets/bootstrap-table.min.js"></script>
       

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body>

<div class="container-fluid"  style="margin-top: 140px; margin-bottom: 1%;">
	
		
	
	
	<div class="row" >
		<div class="col-md-2 col-sm-2">
<nav class="navbar navbar-default sidebar" role="navigation" style="border: none;background: none"> <!-- style="height: 500px;" -->
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
       
       <!--
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Order History <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="userordershistory.php?otype=dryclean">Dryclean Orders</a></li>
            <li><a href="userordershistory.php?otype=laundry">Laundry Orders</a></li>
          
          </ul>
        </li>   
       -->
      
          <li ><a href="userorderhistory.php">Order History<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
        
         <li class="dropdown">
          <a href="userindex.php" class="dropdown-toggle" data-toggle="dropdown"> My Subscriptions <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="usersubscription.php?ref=current">Current Subscriptions</a></li>
            <li><a href="usersubscription.php?ref=previous">Previous Subscriptions</a></li>
          </ul>        </li>   
        <li><a href="userprofile.php">My Profile<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>        
        <li><a href="index.php#assist">Assist Me<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
      </ul>
    </div>
  </div>
</nav>
</div>

	
	