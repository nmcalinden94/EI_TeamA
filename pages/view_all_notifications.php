<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>EI | Notifications</title>
    <meta content=
    'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
    name='viewport'><!-- bootstrap 3.0.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- font Awesome -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Ionicons -->
    <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css">
	

    <!-- DATA TABLES -->
    <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	
	<link href="tab-spacing.css" rel="stylesheet" type="text/css" />
    
		
	<!-- JS PDF -->
    <script src="../js/EI/PDF/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="../js/EI/PDF/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
    <script src="../js/EI/PDF/jspdf.debug.js" type="text/javascript"></script>
	
	
	<!-- globals -->
	<script src="../js/EI/EI_StatementExample.js" type="text/javascript"></script>
	
	
	
	
   
</head>
<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a class="logo" href="../index.php">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
         <img height="45" src="../img/ElectricIreland/brand_logo2.png"></a> 
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
             <a class="navbar-btn sidebar-toggle" data-toggle="offcanvas" href=
            "#" role="button"><span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span> <span class="icon-bar"></span>
            <span class="icon-bar"></span></a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning"><?php
								include '../notifications.php';								
								echo $_SESSION['number_rows']?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><?php echo $_SESSION['text_number_rows'] ?></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu"><?php foreach($_SESSION['notifications'] as $value): ?>	
													<li>
													<a href="#">
													<i class="fa fa-gbp"></i> <?php echo $value; ?>
													</a>
													</li>
											 <?php endforeach; ?>										
                                    </ul>
                                </li>
                                <li class="footer"><a href="view_all_notifications.php">View all</a></li>
                            </ul>
                        </li>
                    <li>
                         <a href="../logout.php"><label>Sign Out</label></a>
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
                        <a href="../index.php"><i class="fa fa-home"></i>
                        <span>Home</span></a>
                    </li>
                    <li>
                        <a href="payasyougo/pay_as_you_go.php"><i class=
                        "fa fa-mobile"></i> <span>Pay As You Go</span>
                        <small class=
                        "badge pull-right bg-green">new</small></a>
                    </li>
                    <li>
                        <a href="charts/usageCharts.php"><i class=
                        "fa fa-bar-chart-o"></i> <span>Energy Usage</span></a>
                    </li>
                    <li class="active">
                        <a href="recent_bills.php"><i class="fa fa-book"></i>
                        <span>Recent Bills</span></a>
                    </li>
                    <li>
                        <a href="contactus/contact_us.php"><i class=
                        "fa fa-envelope"></i> <span>Contact Us</span></a>
                    </li>
                    <li>
                        <a href="../myaccount.php"><i class="fa fa-user"></i>
                        <span>My Account</span></a>
                    </li>
                </ul>
            </section><!-- /.sidebar -->
        </aside>
        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1>               
                <small>Notifications</small>
            </h1>
                <ol class="breadcrumb">
                    <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Notifications</li>
                </ol>
            </section> 
            <section class="content">
             <div class="row">
             <div class="col-xs-12">

			<div class="box">
                            <div class="box-header"></div><!-- /.box-header -->
                            <div class="box-body table-responsive">
								<table class="table table-bordered table-hover" id="notifications_table">
								<thead>
									<tr>
										<th>Debit Date</th>
										<th>Debit Amount</th>
										<th>Account Name</th>
										<th>Account Number</th>
									</tr>
				
                                    </thead>
								
                                    <tbody>
                                        <?php
										
										$userId = $_SESSION['user-id'];
										//Connect Database
										require_once '../DB_connect.php';
										
										//Link User ID
										$user_id = $_SESSION['user-id'];
										
										$query = "SELECT * FROM `ei_saveDirectDebit` WHERE IF(DAY(CURRENT_DATE()) = 1,
										DAY( `direct_debit_date` ) >= DAY(DATE_SUB( NOW() + INTERVAL 1 DAY, INTERVAL 1 DAY )),
										DAY( `direct_debit_date` ) = DAY(DATE_SUB( NOW() + INTERVAL 1 DAY, INTERVAL 1 DAY ))
										) AND  MONTH(direct_debit_date) <= MONTH(NOW()) AND `ei_userid`= '$userId'";
										$result = mysql_query($query);

                                            
                                                                         
                                                                         while ($row = mysql_fetch_array($result)) { ?>
                                        <tr class="clickable-row">
                                            <td><?php echo $row[4]; ?></td>
                                            <td><?php echo $row[0]; ?></td>
                                            <td><?php echo $row[1]; ?></td>
											<td><?php echo $row[3]; ?></td>
                                        </tr>
										<?php } ?>
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
						</div>
                </div>
            </section>
        </aside>
    </div>
    	<footer>
    				<div class="footer" id="footer">
        				<div class="container">
            				<div class="row">
                				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    				<h3> Services </h3>
                    				<ul>
                        				<li> <a href="../index.php"> Home </a> </li>
                        				<li> <a href="payasyougo/pay_as_you_go.php"> Pay As You Go </a> </li>
                        				<li> <a href="charts/usageCharts.php"> Energy Usage </a> </li>
                        				<li> <a href="recent_bills.php"> Recent Bills </a> </li>
                    				</ul>
                				</div>
                				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    				<h3> Pay As You Go </h3>
                    				<ul>
                       					<li> <a href="payasyougo/pay_as_you_go.php"> Pay As You Go </a> </li>
                        				<li> <a href="payasyougo/terms&conditions.php"> Terms & Conditions </a> </li>
                        				<li> <a href="payasyougo/DirectDebitInformation.php"> Direct Debit Information </a> </li>
                        				<li> <a href="payasyougo/DirectDebitHowToCancel.php"> How To Cancel Direct Debit</a> </li>
                    				</ul>
                				</div>
                				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    				<h3> Help </h3>
                    				<ul>
                        				<li> <a href="contactus/contact_us.php"> Contact Us </a> </li>
                        				<li> <a href="#"> FAQ </a> </li>
                    				</ul>
                				</div>
                			<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    			<h3> My Account </h3>
                    			<ul>
                        			<li> <a href="../myaccount.php"> My Account </a> </li>
                        			<li> <a href="../logout.php"> Sign Out </a> </li>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> 
	
	<!-- Bootstrap --> 
    <script src="../js/bootstrap.min.js" type="text/javascript"></script> 
	
	<!-- AdminLTE App --> 
    <script src="../js/AdminLTE/app.js" type="text/javascript"></script> 
	
	<!-- DATA TABES SCRIPT -->
    <script src="../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script> 
    <script src="../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script> 
	
	<!-- Custom -->
	<script src="../js/EI/notifications.js" type="text/javascript"></script>
	

	
</body>
</html>           