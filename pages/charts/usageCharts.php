<!DOCTYPE html>
<?php

session_start();
//session code
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "";
} else {
    echo "Please log in first to see this page.";
	header('Location: ../../login.php');
	die();
}
// if last request was more than 30 minutes ago, kill session and redirect to login page
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();     
    session_destroy(); 
	header('Location: ../../logout.php');
}
$_SESSION['LAST_ACTIVITY'] = time(); 

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Electric Ireland | Energy Usage</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris charts -->
        <link href="../../css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
		
		<!--[if IE]><script type="text/javascript" src="excanvas.js"></script><![endif]-->
		
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
		      <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
		
		  <script type="text/javascript">

        jQuery(document).ready(function () {
           
			 //$("#donutDiv").show();
           //  $("#lineDiv").hide();
             //$("#barDiv").hide();
	});
        
    </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="../../index.php" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            <img src="../../img/ElectricIreland/brand_logo2.png" height="45" />
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
               <ul class="nav navbar-nav">
                       
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning"><?php
								include '../../notifications.php';								
								echo $_SESSION['number_rows']?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><?php echo $_SESSION['text_number_rows'] ?></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu"><?php foreach($_SESSION['notifications'] as $value): ?>	
													<li>
													<a href="../view_all_notifications.php">
													<i class="fa fa-gbp"></i> <?php echo $value; ?>
													</a>
													</li>
											 <?php endforeach; ?>										
                                    </ul>
                                </li>
                                <li class="footer"><a href="../view_all_notifications.php">View all</a></li>
                            </ul>
							
							
                        </li>
                 <li>
				 
				 <a href="../../logout.php"><label>Sign Out</label></a>
				 
				 </li>
				
            
                    </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
               
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li>
                        <a href="../../index.php">
                            <i class="fa fa-home"></i> <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="../payasyougo/pay_as_you_go.php">
                            <i class="fa fa-mobile"></i> <span>Pay As You Go</span> <small class="badge pull-right bg-green">new</small>
                        </a>
                    </li>
                    <li class="treeview active">
                        <a href="usageCharts.php">
                            <i class="fa fa-bar-chart-o"></i>
                            <span>Energy Usage</span>
                        </a>
                    </li>

                    <li>
                        <a href="../recent_bills.php">
                            <i class="fa fa-book"></i> <span>Recent Bills</span>
                        </a>
                    </li>

                    <li>
                        <a href="../contactus/contact_us.php">
                            <i class="fa fa-envelope"></i> <span>Contact Us</span>
                        </a>
                    </li>

                    <li>
                        <a href="../../myaccount.php">
                            <i class="fa fa-user"></i> <span>My Account</span>
                        </a>
                    </li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Energy Usage

                </h1>
                <ol class="breadcrumb">
                    <li><a href="../../index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#">Energy Usage</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
			
                <div class="col-md-12 text-center">
                    
					<a href="#" class="btn btn-primary" style="background-color:#009FDA" role="button">Daily Usage</a>
                      <a href="weeklyChart.php" class="btn btn-primary" style="background-color:#009FDA" role="button">Weekly Usage</a>
                      <a href="monthlyCharts.php" class="btn btn-primary" style="background-color:#009FDA" role="button">Monthly Usage</a>
                    </div>
                    
                    
                <div id="donutDiv">
                    <div class="row col-md-12">
                        <!-- DONUT CHART -->
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title">Daily Usage</h3>
								
								<br></br>
							
                            </div>
							
							<div class="text-center row col-md-12">
							<div class="col-md-12 alert alert-info" role="alert">
							<div class="row">Your peak use was at    <text id="peakUseTime" style="font-size:24px"></text> And you used 
							<text style="font-size:24px" id="peakUseText"></text> </div> 
							
							<div class="row">Your overall usage today:
							<text style="font-size:24px" id="overallUsage"></text></div></div>

							</div>
							<div class="row col-md-12 text-center">
							<h4 id="dayString"></h3>
							<button class="btn btn-primary" style="background-color:#009FDA" id="changeDateBack">Previous Day</button>
							<button class="btn btn-primary" style="background-color:#009FDA" id="changeDate">Next Day</button>
							</div>
							
                            <div>
                                 <canvas id="usageLine" width=1000 height=300></canvas>
								 
							<script src="scripts/dailyUse.js">
							
							</script>
 
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>
				
				
                         
                           
                     
                     
              
                            
</section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
    	<footer>
    				<div class="footer" id="footer">
        				<div class="container">
            				<div class="row">
                				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    				<h3> Services </h3>
                    				<ul>
                        				<li> <a href="../../index.php"> Home </a> </li>
                        				<li> <a href="../payasyougo/pay_as_you_go.php"> Pay As You Go </a> </li>
                        				<li> <a href="usageCharts.php"> Energy Usage </a> </li>
                        				<li> <a href="../recent_bills.php"> Recent Bills </a> </li>
                    				</ul>
                				</div>
                				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    				<h3> Pay As You Go </h3>
                    				<ul>
                       					<li> <a href="../payasyougo/pay_as_you_go.php"> Pay As You Go </a> </li>
                        				<li> <a href="../payasyougo/terms&conditions.php"> Terms & Conditions </a> </li>
                        				<li> <a href="../payasyougo/DirectDebitInformation.php"> Direct Debit Information </a> </li>
                        				<li> <a href="../payasyougo/DirectDebitHowToCancel.php"> How To Cancel Direct Debit</a> </li>
                    				</ul>
                				</div>
                				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    				<h3> Help </h3>
                    				<ul>
                        				<li> <a href="../contactus/contact_us.php"> Contact Us </a> </li>
                        				<li> <a href="#"> FAQ </a> </li>
                    				</ul>
                				</div>
                			<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    			<h3> My Account </h3>
                    			<ul>
                        			<li> <a href="../../myaccount.php"> My Account </a> </li>
                        			<li> <a href="../../logout.php"> Sign Out </a> </li>
                    			</ul>
                			</div>
                			<div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                    			<h3> Connect </h3>
                    			<ul class="social">
                        			<li> <a href="https://www.facebook.com/ElectricIreland"> <i class=" fa fa-facebook">   </i> </a> </li>
                        			<li> <a href="https://twitter.com/electricireland"> <i class="fa fa-twitter">   </i> </a> </li>
                        			<li> <a href="https://www.instagram.com/electricireland/"> <i class="fa fa-instagram">   </i> </a> </li>
                        			<li> <a href="https://www.linkedin.com/company/electric-ireland"> <i class="fa fa-linkedin">   </i> </a> </li>
                        			<li> <a href="https://www.youtube.com/user/ELECTRICIRELAND"> <i class="fa fa-youtube">   </i> </a> </li>
                        			<br/>
                    			</ul>
                    			<br/>
                    			<p class="pull-left"> Copyright © Team A 2016. </p>
                    			<p class="pull-left"> All right reserved. </p>
                			</div>
            			</div>
            		<!--/.row--> 
        			</div>
        		<!--/.container--> 
    			</div>
    		<!--/.footer-->
		</footer>
    <!-- jQuery 2.0.2 -->
    <!-- Bootstrap -->
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Morris.js charts -->
  <script>
  </script>

    <!-- AdminLTE App -->


    <!-- page script -->
    

</body>

</html>