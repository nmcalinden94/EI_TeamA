<!DOCTYPE html>
<?php
session_start();

$tester = $_SESSION['user-id'];

//session code
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "";
} else {
    echo "Please log in first to see this page.";
	header('Location: login.php');
	die();
}
// if last request was more than 30 minutes ago, kill session and redirect to login page
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();     
    session_destroy(); 
	header('Location: logout.php');
}
$_SESSION['LAST_ACTIVITY'] = time(); 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Electric Ireland</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
		 
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- iPhone Home -->
		<link rel="apple-touch-icon" href="img/ElectricIreland/iphoneHome.png"/> 

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		
		
    </head>
    <body class="skin-blue bg-gray">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="img/ElectricIreland/brand_logo2.png" height="45"/>
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
								include 'notifications.php';								
								echo $_SESSION['number_rows']?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><?php echo $_SESSION['text_number_rows'] ?></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu"><?php foreach($_SESSION['notifications'] as $value): ?>	
													<li>
													<a href="pages/view_all_notifications.php">
													<i class="fa fa-gbp"></i> <?php echo $value; ?>
													</a>
													</li>
											 <?php endforeach; ?>										
                                    </ul>
                                </li>
                                <li class="footer"><a href="pages/view_all_notifications.php">View all</a></li>
                            </ul>
							
							
                        </li>
                 <li>
				 
				 <a href="logout.php"><label>Sign Out</label></a>
				 <!--<a href="login.php" action="session_ending.php"><label>Sign Out</label></a>-->
				 
				 </li>
				
            
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas collapse-left">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.php">
                                <i class="fa fa-home"></i> <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="pages/payasyougo/pay_as_you_go.php">
                                <i class="fa fa-mobile"></i> <span>Pay As You Go</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
						<li>
                            <a href="pages/charts/usageCharts.php">
								<i class="fa fa-bar-chart-o"></i> <span>Energy Usage</span> 
                            </a>
                        </li>
                      
                        <li>
                            <a href="pages/recent_bills.php">
                                <i class="fa fa-book"></i> <span>Recent Bills</span>
                            </a>
                        </li>

                        <li>
                            <a href="pages/contactus/contact_us.php">
                                <i class="fa fa-envelope"></i> <span>Contact Us</span>
                            </a>
                        </li>

                        <li>
                            <a href="myaccount.php">
                                <i class="fa fa-user"></i> <span>My Account</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside id="left-wrapper-close" class="right-side strech">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <label><bold><?php 
						require_once 'DB_connect.php';
						
						$business = $_SESSION['business'];
						
						if($business!="")
						{
							echo $business;
						}
						else{
							echo $_SESSION['account_no'];
						}
						
						

						?></bold></label>
                        <small>Overview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content bg-gray">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="pages/payasyougo/pay_as_you_go.php" id="iTiles" class="small-box bg-white">
                                <div class="inner">
                                        <h4><b>SMART Pay As You Go</b></h4>
                              <br />
                                    <p> Current Balance: £<?php
								//Connect Database
								require_once 'DB_connect.php';
	
								//Link User ID
								$user_id = $_SESSION['user-id'];		

								//Get Balance
								$result = mysql_query("SELECT COALESCE(SUM(top_up_amount), 0) AS Balance FROM ei_submitTopUpPayment WHERE ei_userid = '$user_id'") or die(mysql_error());
								if(is_resource($result) and mysql_num_rows($result)>0){
    							$row = mysql_fetch_array($result);
    							echo $row["Balance"];}?></p>
                                </div>
							
                                <div class="icon">
                                    <i id="inIcons" class="fa fa-mobile"></i>
                                </div>
                                <div class="small-box-footer bg-white" style="color:#009FDA">
                                    Enter <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </a>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="pages/charts/usageCharts.php" id="iTiles" class="small-box bg-white">
                                <div class="inner">
                                    <h4>
                                        <b>
                                            Statistics
                                        </b>                           
                                    </h4>
                                    <br />
                                   <p>
                                        Average Energy Usage: <text id="averageTime"></text>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i  id="inIcons" class="ion ion-stats-bars" ></i>
                                </div>
                                <div class="small-box-footer bg-white" style="color:#009FDA">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </a>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="pages/recent_bills.php" id="iTiles" class="small-box bg-white">
                                <div class="inner">
                                    <h4><b>
                                        Recent Bills
                                        </b>                           
                                    </h4>
                                    <br />
                                    <p id="connectionTest">
                                        View recent bills and reports
                                    </p>
                                </div>
                                <div class="icon">
                                    <i id="inIcons" class="fa fa-book"></i>
                                </div>
                                <div class="small-box-footer bg-white" style="color:#009FDA">
                                    Go to  <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </a>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="myaccount.php" id="iTiles" class="small-box bg-white">
                                <div class="inner">
                                    <h4>
                                        <b>My Account</b>
                                    </h4>
                                    <br />
                                    <p>
                                       <?php 
						require_once 'DB_connect.php';
						
						$business = $_SESSION['business'];
						
						if($business!="")
						{
							echo $business;
						}
						else{
							echo $_SESSION['account_no'];
						}
						
						

						?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i id="inIcons" class="ion ion-person-add"></i>
                                </div>
                                <div class="small-box-footer bg-white" style="color:#009FDA">
                                    Go to <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </a>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">                           
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6"> 
                            <!-- Box (with bar chart) -->
                            <div class="box" id="loading-example">
                                <div class="box-header">
								<h4 class="box-title">Energy Daily Interval Reading</h4>
								<div class="row">
								</div>
									<div class="row">
									<h4 class="text-center" id="todayDate"></h4></div>
									 <div class="box-body col-lg-11">
                                 <canvas id="c" ></canvas>
                            </div><!-- /.box-body-->
							
                                </div><!-- /.box-header -->
        
                                </div><!-- /.box-body -->
								
								  </section><!-- Left col -->
						
						<!-- Right col -->
                        <section class="col-lg-6"> 
						
						<div class="box" height="200px">
                                <div class="box-header">
                                    <h3 class="box-title">Recent Activity </h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table id="payments_table" class="table table-responsive">
									<thead>
                                        <tr>
                                            <th></th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
									</thead>
                                        <tbody>
                                        <?php
                                                                            
                                            require_once 'DB_connect.php';
                                            
                                            $userID = $_SESSION['user-id'];
                                           
											
                                            $sql = "SELECT * FROM `ei_billing` WHERE `user_id` = '$userID' ORDER BY `date` DESC limit 5";
                                            
                                            $result = mysql_query($sql);
                                                                         
                                                                         while ($row = mysql_fetch_array($result)) { ?>
                                        <tr>
                                            <td><?php echo $row[2]; ?></td>
                                            <td><?php echo $row[5]; ?></td>
                                            <td class="Status"><b><?php echo $row[4]; ?></b></td>
                                        </tr>
										<?php } ?>
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->		
						</section>
                    </div><!-- /.box -->        
                <footer>
    				<div class="footer" id="footer">
        				<div class="container">
            				<div class="row">
                				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    				<h3> Services </h3>
                    				<ul>
                        				<li> <a href="index.php"> Home </a> </li>
                        				<li> <a href="pages/payasyougo/pay_as_you_go.php"> Pay As You Go </a> </li>
                        				<li> <a href="pages/charts/usageCharts.php"> Energy Usage </a> </li>
                        				<li> <a href="pages/recent_bills.php"> Recent Bills </a> </li>
                    				</ul>
                				</div>
                				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    				<h3> Pay As You Go </h3>
                    				<ul>
                       					<li> <a href="pages/payasyougo/pay_as_you_go.php"> Pay As You Go </a> </li>
                        				<li> <a href="pages/payasyougo/terms&conditions.php"> Terms & Conditions </a> </li>
                        				<li> <a href="pages/payasyougo/DirectDebitInformation.php"> Direct Debit Information </a> </li>
                        				<li> <a href="pages/payasyougo/DirectDebitHowToCancel.php"> How To Cancel Direct Debit</a> </li>
                    				</ul>
                				</div>
                				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    				<h3> Help </h3>
                    				<ul>
                        				<li> <a href="pages/contactus/contact_us.php"> Contact Us </a> </li>
                        				<li> <a href="#"> FAQ </a> </li>
                    				</ul>
                				</div>
                			<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    			<h3> My Account </h3>
                    			<ul>
                        			<li> <a href="myaccount.php"> My Account </a> </li>
                        			<li> <a href="logout.php"> Sign Out </a> </li>
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
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 --> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		
		<script type="text/javascript">
		
		$(document).ready(function(){
			$('#payments_table td.Status').each(function(){
				if ($(this).text() == 'Completed') {
					$(this).css('color','#58A618');
				}
				else if ($(this).text() == 'Failed') {
					$(this).css('color','red');
				}
				else if($(this).text() == 'Pending') {
					$(this).css('color','orange');
				}
			});
				
			});
		
		</script>
		
		
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
		
		
		<script src="indexDaily.js"></script>
		<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
		   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

    </body>
</html>