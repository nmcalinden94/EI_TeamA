<!DOCTYPE html>
<?php
session_start();
//session code
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
{
    echo "";
} 
else 
{
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
        <title>Electric Ireland | Pay As You Go</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- daterange picker -->
        <link href="../../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="../../css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="../../css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="../../css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Fancybox -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="../../js/fancybox/source/jquery.fancybox.pack.js"></script>
        <link rel="stylesheet" href="../../js/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
        <!-- Tab Spacing -->
        <link href="../tab-spacing.css" rel="stylesheet" type="text/css" />
        <!-- Radio CSS -->
        <link href="../../css/radio.css" rel="stylesheet" type="text/css" />
        <!-- Card Type Validation -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    	<script src="../../js/js-creditcardvalidator/jquery.creditCardValidator.js"></script>
    	<script type='text/javascript'>var $jq = jQuery.noConflict();</script>
    	<!-- Sweet Alert -->
    	<script src="../../js/sweetalert/dist/sweetalert.min.js"></script> 
    	<link rel="stylesheet" type="text/css" href="../../js/sweetalert/dist/sweetalert.css">
    	<!-- iPhone Home -->
		<link rel="apple-touch-icon" href="../../img/ElectricIreland/iphoneHome.png"/>  

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
                        <li class="active">
                            <a href="pay_as_you_go.php">
                                <i class="fa fa-mobile"></i> <span>Pay As You Go</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
						<li>
                            <a href="../charts/usageCharts.php">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Energy Usage</span>
                            </a>
                      
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
                <label><bold><?php 
				require_once '../../DB_connect.php';					
				echo $_SESSION['business'];
				?></bold></label>
                <small>Pay As You Go</small>
            </h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Pay As You Go</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
            <!-- START CUSTOM TABS -->
            <div class="row">
            	<div class="col-md-6 col-md-offset-3">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                
                <ul class="nav nav-tabs" role="tablist">
					<li class="active take-all-space-you-can">
						<a href="#tab_1" role="tab" data-toggle="tab">
							<i class="fa fa-money"></i> Top-Up
						</a>
					</li>
					<li class="take-all-space-you-can">
						<a href="#tab_2" role="tab" data-toggle="tab">
							<i class="fa fa-credit-card"></i> Direct Debit
						</a>
					</li>
				</ul>
            		<div class="tab-content">
            		                                        
                        <!-- Tab 1 - Top Up  -->
                        <div class="tab-pane active" id="tab_1">
                        <form name="TopUpForm" id="TopUpForm" autocomplete="off" method="post" action="?">
                        	<body class="skin-blue">
                        	
    						<!-- Top Up Amount -->
                            <div class="form-group">
                            <br/>   
                                <h5 class="text-center"><font color="009FDA">How Much Would You Like To Top-Up? *</font></h5>
                                <div class="form-group text-center">                              
                                    <div class="form-group">
                                    <fieldset class="question">
                                    <?php require_once '../../userDetails.php';?>   
                                        <label><input type="radio" name="pricetype" id="pricetype" class="square-blue" value="25" required/> £25</label>
                                        <label><input type="radio" name="pricetype" id="pricetype" class="square-blue" value="50" required/> £50</label>
                                        <label><input type="radio" name="pricetype" id="pricetype" class="square-blue" value="75" required/> £75</label>
                                        <label><input type="radio" name="pricetype" id="pricetype" class="square-blue" value="100" required/> £100</label>
                                    </fieldset>
                                    </div>
                                    <div class="box-footer">
                                    </div>
                                </div>
                                
                            </div>
                            
                            <!-- Payment Type -->
                            <div class="form-group">
                                <h5 class="text-center"><font color="009FDA">Card Number? *</font></h5>
                                <div class="text-center">
                                <fieldset class="question">
                                        <input type="tel" minlength="19" maxlength="19" name="card_number" id="card_number" onKeyup="addHyphen()" type="number" class="Input" placeholder="0000-0000-0000-0000" value="<?php require_once '../../userDetails.php'; echo $loadCard_Number ?>" required>
											<p hidden class="log"></p>
                                    	</fieldset>
                                    <div class="box-footer">
                                    </div>
                                </div>
                                <div class="text-center">
                                	<img src="../../img/credit/acceptedpayments.png" style="width:200px;height:20px;" />
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="row">
                                	<!-- Cardholders Name -->
                                    <div class="col-xs-6 text-center">
                                        <h5><font color="009FDA">Card Holder's Name *</font></h5>
                                        <fieldset class="question">
                                        <input id="cardholderid" name="cardholderid" type="text" class="Input" placeholder="MR JOHN SMITH" onkeypress="return alphaOnly(event);" minlength="5" maxlength="40" required value="<?php require_once '../../userDetails.php'; echo $loadCard_Name ?>"  >
                                        </fieldset>
                                    </div>
									
									<!-- Security Code -->
                                    <div class="col-xs-6 text-center">
                                        <h5><font color="009FDA">CVV *</font><a id="?" class= "letter image_fancybox" data-fancybox-group="group" href="../../img/credit/security-codes-cc.jpg">  ?</a></h5>
                                        <fieldset class="question">
                                        <input id="securitycodeid" name="securitycodeid" type="tel" minlength="3" maxlength="3" class="InputSec" placeholder="000" value="<?php require_once '../../userDetails.php'; echo $loadCard_Code ?>" required >
                                    	</fieldset>
                                    </div>
								</div>
								
								<div class="row">
									<!-- Expiry Date -->
                                    <div class="col-xs-6 text-center">
                                        <h5><font color="009FDA">Expiry Date *</font></h5>
                                        <fieldset class="question">                                            
    									<input 
    										id="expirydate3id"
           									required
           									name="expirydate3id"
           									class="Date Date-picker Input--noSpinner" 
           									type="month" 
           									min="<?php echo date('Y-m', strtotime(' + 0 days')); ?>" 
           									max="<?php echo date('Y-m', strtotime(' +  1825 days')); ?>" 
           									placeholder="mm-yyyy" 
           									data-date='{"buttonOnly": true}'
           									value="<?php require_once '../../userDetails.php'; echo $loadCard_Date ?>"
           								/>
           								</fieldset>
                                    </div>

									<!-- Top Up T&Cs -->
									<div class="col-xs-6 text-center">
										<br/>
                            			<div class="checkbox">
                            			<fieldset class="question">
                                			<label><input name="terms1" id="terms1" type="checkbox" class="square-blue" required autofocus> I accept the </label>
                                            <a id="terms&condit" class= "letter fancybox" data-fancybox-group="group" href="terms&conditions.php"><font size="2">Terms & Conditions *</font></a>	 
                                		</fieldset>
                                		</div>
                                	</div>
                                	</div>
								<div class="row">
                                   <!-- Submit & Save Button -->
                                   <br/>
                                    <div class="col-xs-12 text-center">
                                    <?php
										$confirmPassword_error='';
										require_once '../../DB_connect.php';
											if(empty($_POST) === false)
											{
												//Link User ID
												$user_id = $_SESSION['user-id'];
	
												//Passed variables from html
												$cardholderid = mysql_real_escape_string($_POST["cardholderid"]);
												$card_number = mysql_real_escape_string($_POST["card_number"]);
												$securitycodeid = mysql_real_escape_string($_POST["securitycodeid"]);
												$expirydate3id = mysql_real_escape_string($_POST["expirydate3id"]);
	
												//Insert if the card number doesn't already exist
												$query = "INSERT INTO `ei_saveTopUpDetails` (`cardholder_name`, `card_number`, `security_code`, `expiry_date`, `ei_userid`, `save_id`) 
												VALUES ('$cardholderid', '$card_number', '$securitycodeid', '$expirydate3id', '$user_id', NULL);";
												$result = mysql_query($query); 
		
												if ($result) 
												{
													$confirmPassword_error='Card Saved';
												}
												else
												{		
													$confirmPassword_error='Card Already Saved';
												}
											}
										?>
                                    	<button class="btn btn-success" id="btnSubmit" name="btnSubmit" onclick="submitTopform();return true;"><i class="fa fa-check-circle-o"></i> Submit</button>
                                    	<button class="btn btn-success" type="submit" id="myPayment_Submit" name="myPayment_Submit"><i class="fa fa-save"></i> Save Card</button>
                                    	<button class="btn btn-success" type="button" id="myPayment_edit" name="myPayment_edit" onclick="editCard();return true;"><i class="fa fa-edit"></i> Edit Card</button>    
                                    </div>
								</div>
								<div class="row">
								<br/>
									<div class="col-xs-12 text-center">
										<p id="confirmPasswordError"><?php echo $confirmPassword_error ?></p>
									</div>
								<br/>
								</div>
							</div>
						</form>
                    </div><!-- /.tab-pane -->
                                                                  
                    <!-- Tab 2 Direct Debit  -->
                    <div class="tab-pane" id="tab_2">
                    <form id="DebitForm" name="DebitForm" autocomplete="off" method="post" action="#!">                              
                            <div class="tab-content">
                                	<div class="form-group">
                                		<!-- Direct Debit Amount -->
                                		<img src="../../img/ElectricIreland/directdebit.png" style="width:30px;height:30px;">
                                		<h5 class="text-center"><font color="009FDA">Direct Debit Amount? *</font></h5>
                                		<div class="form-group text-center">
                                			<div class="form-group">
                                			<fieldset class="question">
                                    			<label><input type="radio" name="debittype" id="debittype" class="square-blue" value="100" <?php require_once '../../userDetails.php'; echo ($directDebit_Amount=='100')?'checked':'' ?> required/>£100</label>
                                    			<label><input type="radio" name="debittype" id="debittype" class="square-blue" value="250" <?php require_once '../../userDetails.php'; echo ($directDebit_Amount=='250')?'checked':'' ?> required/>£250</label>
                                    			<label><input type="radio" name="debittype" id="debittype" class="square-blue" value="500"  <?php require_once '../../userDetails.php'; echo ($directDebit_Amount=='500')?'checked':'' ?> required/>£500</label>
                                    			<label><input type="radio" name="debittype" id="debittype" class="square-blue" value="1000"  <?php require_once '../../userDetails.php'; echo ($directDebit_Amount=='1000')?'checked':'' ?> required/>£1000</label>
                                			</fieldset>
                                			</div>
                                			<div class="box-footer">
                                			</div>
                                		</div>
                            		</div>
                            		
                            		<div class="form-group">
                            			<!-- Direct Debit Start Date -->
                                		<h5 class="text-center"><font color="009FDA">Direct Debit Start Date? *</font></h5>
                                		<div class="text-center">
                                		<fieldset class="question">
                                    		<input 
    										id="input-datepicker"
           									required
           									name="directdebitdate3id"
           									class="Date Date-picker Input--noSpinner" 
           									type="date" 
           									min="<?php echo date('Y-m-d', strtotime(' + 0 days')); ?>" 
           									max="<?php echo date('Y-m-d', strtotime(' + 31 days')); ?>" 
           									placeholder="dd-mm-yyyy" 
           									data-date='{"buttonOnly": true}'
           									value="<?php require_once '../../userDetails.php'; echo $directDebit_Date ?>"
           								/>
           								</fieldset>
                                    		<div class="box-footer text-center">
                                    			<font size="1"> (Max 31 Days After Today)</font>
                                    		</div>
                                		</div>
                            		</div>
                            		
                            		<div class="box-body">
                                		<div class="row">
                                			<!-- Direct Debit Account Name -->
                                    		<div class="col-xs-6 text-center">
                                        		<h5><font color="009FDA">Account Name *</font></h5>
                                        		<fieldset class="question">
                                        		<input id="accountnameInput" name="accountnameid" type="text" class="Input" placeholder="MR JOHN SMITH" value="<?php require_once '../../userDetails.php'; echo $directDebit_Name ?>" onkeypress="return alphaOnly(event);" minlength="5" maxlength="40" required>
                                    		    </fieldset>
                                    		</div>
											
											<!-- Direct Debit Sort Code -->
                                    		<div class="col-xs-6 text-center">
                                        		<h5><font color="009FDA">Sort Code *</font></h5>
                                        		<fieldset class="question">
                                        		<input id="sortcodeInput" name="sortcodeid" type="tel" minlength="8" maxlength="8" class="InputSec" onKeyup="addHyphen()" placeholder="00-00-00" value="<?php require_once '../../userDetails.php'; echo $directDebit_Number ?>" required>
                                        		</fieldset>
                                    		</div>
										</div>
										
										<div class="row">
											<!-- Direct Debit Account Number -->
                                    		<div class="col-xs-6 text-center">
                                        		<h5><font color="009FDA">Account Number *</font></h5>
                                        		<fieldset class="question">
                                        		<input id="accountnumberInput" name="accountnumberid" type="tel" minlength="11" maxlength="11" class="InputSec" onKeyup="addHyphen()" placeholder="00-00-00-00" value="<?php require_once '../../userDetails.php'; echo $directDebit_Sort ?>" required>
                                        		</fieldset>
                                    		</div>
                                    		
                                    		<!-- Direct Debit Info -->
                                    		<div class="col-xs-6 text-center" id="info">
                                    			<br/>
                                       			 <a id="debitinfo" class= "letter fancybox" data-fancybox-group="group" href="DirectDebitInformation.php"><font size="2">Direct Debit Information</font></a>
                                       			 <br/>
                                       			 <a id="debitcancel" class= "letter fancybox" data-fancybox-group="group" href="DirectDebitHowToCancel.php"><font size="2">How to cancel?</font></a>
                                    		</div>

											<!-- Direct Debit T&Cs -->
                                    		<div class="col-xs-6 text-center" id="terms">
                                    			<br/>
                            					<div class="checkbox">
                            					<fieldset class="question">
                                            		<label><input name="terms" id="terms" type="checkbox" class="square-blue" required autofocus> I accept the </label>
                                            		<a id="terms&condit" class= "letter fancybox" data-fancybox-group="group" href="terms&conditions.php"><font size="2">Terms & Conditions *</font></a>
                                            	</fieldset>
                                       			 </div>
                                       			 <a id="debitinfo" class= "letter fancybox" data-fancybox-group="group" href="DirectDebitInformation.php"><font size="2">Direct Debit Information</font></a>
                                    		</div>
                                    	</div>
                                    	<div class="row">
                                    	<br/>
                                    		<!-- Direct Debit Submit Button -->
                                    		<div class="col-xs-12 text-center">
                                    			<button class="btn btn-success" id="btnSubmit1" name="btnSubmit1" onclick="submitDebitform();return true;"><i class="fa fa-check-circle-o"></i> Submit</button>
                                    		</div>
                                    		<br/>
                                    		<br/>
                                    		<br/>
                                    		<br/>
										</div>
                                </form>
                            </div><!-- /.tab-pane -->                  
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
        </div> <!-- /.row -->
    	<!-- END CUSTOM TABS -->
	</div><!-- /.box-body -->

</div><!-- /.box -->
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
                        				<li> <a href="../../index.php"> Home </a> </li>
                        				<li> <a href="pay_as_you_go.php"> Pay As You Go </a> </li>
                        				<li> <a href="../charts/usageCharts.php"> Energy Usage </a> </li>
                        				<li> <a href="../recent_bills.php"> Recent Bills </a> </li>
                    				</ul>
                				</div>
                				<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    				<h3> Pay As You Go </h3>
                    				<ul>
                       					<li> <a href="pay_as_you_go.php"> Pay As You Go </a> </li>
                        				<li> <a href="terms&conditions.php"> Terms & Conditions </a> </li>
                        				<li> <a href="DirectDebitInformation.php"> Direct Debit Information </a> </li>
                        				<li> <a href="DirectDebitHowToCancel.php"> How To Cancel Direct Debit</a> </li>
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

	<!-- Save Card Details JS -->
	<script src="saveCardDetails.js" type="text/javascript"></script>
	<!-- FancyBox -->
	<script type="text/javascript">
		$(".fancybox").fancybox({
  		 openEffect  : "fade",
   		closeEffect : "fade",
   		type : "iframe",
   		arrows : false,
	});
	</script>
	<!-- FancyBox -->
	<script type="text/javascript">
		$(".image_fancybox").fancybox({
 		openEffect  : "fade",
  		closeEffect : "fade",
   		type : "image",
   		arrows : false,
	});
	</script>
	<!-- FancyBox -->
	<!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
    <!-- InputMask -->
	<script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="../../js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="../../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
    <!-- Webshim Validation -->
    <script src="../../js/js-webshim/minified/polyfiller.js"></script>
    <!-- Card Type Validation -->
    <script>
    $(function() {
        $jq('#card_number').validateCreditCard(function(resultcard) {
			$('.log').html('<strong>Card type: </strong>' + (resultcard.card_type == null ? '-' : resultcard.card_type.name)
			 + '<br><strong>Valid: </strong>' + resultcard.valid
			 + '<br><strong>Length valid: </strong>' + resultcard.length_valid
			 + '<br><strong>Luhn valid: </strong>' + resultcard.luhn_valid);
			 
            if(resultcard.card_type == null)
            {
                $('#card_number').removeClass();
            }
            else
            {
                $('#card_number').addClass(resultcard.card_type.name);
            }
            
            if(!resultcard.valid)
            {
                $('#card_number').removeClass("valid");
            }
            else
            {
                $('#card_number').addClass("valid");
            }     
        });
    });
</script>   
    <!-- Page Script -->
    <script type="text/javascript">
        $(function() {
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
            checkboxClass: 'icheckbox_square',
            radioClass: 'iradio_square'
        });
        	//Blue color scheme for iCheck
        	$('input[type="checkbox"].square-blue, input[type="radio"].square-blue').iCheck({
        	checkboxClass: 'icheckbox_square-blue',
        	radioClass: 'iradio_square-blue'
        });
    });
    </script> 
    <!-- Load Card/Debits -->
    <script>
    $(document).ready(function(){
    
    if(document.getElementById('cardholderid').value != '' )
	{
		document.getElementById("cardholderid").setAttribute("readonly", true);
		document.getElementById("cardholderid").style.backgroundColor = "#e3e3e3";
	}	
	if(document.getElementById('card_number').value != '' )
	{
		document.getElementById("card_number").setAttribute("readonly", true);
		document.getElementById("card_number").style.backgroundColor = "#e3e3e3";
	}
	if(document.getElementById('securitycodeid').value != '' )
	{
		document.getElementById("securitycodeid").setAttribute("readonly", true);
		document.getElementById("securitycodeid").style.backgroundColor = "#e3e3e3";
	}
	if(document.getElementById('expirydate3id').value != '' )
	{
		document.getElementById("expirydate3id").setAttribute("readonly", true);
		document.getElementById("expirydate3id").style.backgroundColor = "#e3e3e3";
	}
	if(document.getElementById('input-datepicker').value != '' )
	{
		document.getElementById("input-datepicker").setAttribute("readonly", true);
		document.getElementById("input-datepicker").style.backgroundColor = "#e3e3e3";
	}
	if(document.getElementById('accountnameInput').value != '' )
	{
		document.getElementById("accountnameInput").setAttribute("readonly", true);
		document.getElementById("accountnameInput").style.backgroundColor = "#e3e3e3";
	}
	if(document.getElementById('sortcodeInput').value != '' )
	{
		document.getElementById("sortcodeInput").setAttribute("readonly", true);
		document.getElementById("sortcodeInput").style.backgroundColor = "#e3e3e3";
	}
	if(document.getElementById('accountnumberInput').value != '' )
	{
		document.getElementById("accountnumberInput").setAttribute("readonly", true);
		document.getElementById("accountnumberInput").style.backgroundColor = "#e3e3e3";
	}
	if(document.getElementById('debittype').value != '' )
	{
		document.getElementById("debittype").setAttribute("readonly", true);
	}
	if(document.getElementById('accountnameInput').value != '' )
	{
		document.getElementById("btnSubmit1").style.display = 'none';
	}
	if(document.getElementById('cardholderid').value != '' )
	{
		document.getElementById("myPayment_Submit").style.display = 'none';
	}
	if(document.getElementById('cardholderid').value == '' )
	{
		document.getElementById("myPayment_edit").style.display = 'none';
	}
	if(document.getElementById('accountnameInput').value != '' )
	{
		document.getElementById("terms").style.display = 'none';
		document.getElementById("terms").style.visibility = "hidden";
		[terms].style.visibility='hidden'
	}
	if(document.getElementById('accountnameInput').value == '' )
	{
		document.getElementById("info").style.display = 'none';
	}
}); 
</script>
    <!-- Sweet Alert -->
    <script>
        document.querySelector('#TopUpForm').addEventListener('submit', function(e) {
            var form = this;
            e.preventDefault();
            swal({
                title: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    swal({
                        title: 'Success!',
                        type: 'success'
                    }, function() {
                        form.submit();
                    });
                    
                } else {
                    swal("Cancelled!", "", "error");
                }
            });
        });
    </script>
    <!-- Sweet Alert -->
    <script>
        document.querySelector('#DebitForm').addEventListener('submit', function(e) {
            var form = this;
            e.preventDefault();
            swal({
                title: "Are you sure want to set up a Direct Debit?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: "No!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    swal({
                        title: 'Success!',
                        text: 'Your direct debit was successfully set up!',
                        type: 'success'
                    }, function() {
                        form.submit();
                    });
                    
                } else {
                    swal("Cancelled", "Your direct debit set up has been cancelled", "error");
                }
            });
        });
    </script>    
</body>
</html>

<!-- Form Actions -->
<script>
function editCard() {  	
	window.location.href ='../../myaccount.php#payment_Details';
}
function saveTopform() {
    document.TopUpForm.action = 'saveTopUpDetails.php';
}
function submitTopform() {
    document.TopUpForm.action = 'submitTopUpPayment.php';
}
function submitDebitform() {
    document.DebitForm.action = 'submitDirectDebit.php';
}
</script>
<script>


function addHyphen() {
$('#card_number').keyup(function () {
    var foo = $(this).val().split("-").join(""); // remove hyphens
    if (foo.length > 0) {
        foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
    }
    $(this).val(foo);
});

$('#sortcodeInput').keyup(function () {
    var foo = $(this).val().split("-").join(""); // remove hyphens
    if (foo.length > 0) {
        foo = foo.match(new RegExp('.{1,2}', 'g')).join("-");
    }
    $(this).val(foo);
});

$('#accountnumberInput').keyup(function () {
    var foo = $(this).val().split("-").join(""); // remove hyphens
    if (foo.length > 0) {
        foo = foo.match(new RegExp('.{1,2}', 'g')).join("-");
    }
    $(this).val(foo);
});
}

</script>
<!-- Webshim Validation -->
<script>
/* WEBSHIM.LIB SETUP
****************************************/

	// only implement  Webshim if not an Android native browser (too buggy)
	var nua = navigator.userAgent;
	var is_android = ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1) && !(nua.indexOf('Chrome') > -1));

	if( is_android ) 
	{
  		webshims.setOptions('forms', 
    	{ 
      		addValidators: true, 
      		customDatalist: true 
    	});
  		webshims.activeLang('en-AU');
  		webshims.polyfill('forms');
	} 
	else 
	{
  		webshims.setOptions('forms', 
    	{ 
    		addValidators: true 
    	},
    	'forms-ext', 
    	{
      		types: 'date number',
      		"number": { "calculateWidth": false },
      		"date": { "calculateWidth": false }
    	});
  		webshims.activeLang('en-AU');
  		webshims.polyfill('forms forms-ext');
	}


	// Change input type to match 'inputmode' on touch devices
	$("html.touch input[type='text']").each( function() 
	{
  		var $t = $(this);
  		if( $t.is("[inputmode='numeric']") ) 
  		{
    		$t.attr("type","number");
  		} 
  		else if( $t.is("[inputmode='tel']") ) 
  		{
    		$t.attr("type","tel");
  		} 
  		else if( $t.is("[inputmode='email']") ) 
  		{
    		$t.attr("type","email");
  		} 
  		else if( $t.is("[inputmode='url']") ) 
  		{
    		$t.attr("type","url");
  		}
	});


	/* DELAYED FORM VALIDATION
	****************************************/
	// Enable validation styling only after field is 'touched'
	$("#TopUpForm .Input, #TopUpForm .Date, #TopUpForm .Datalist, #TopUpForm #card_number, #TopUpForm .InputSec, #DebitForm .Input, #DebitForm .InputSec, #DebitForm .Date, #DebitForm .Datalist").blur( function() 
	{
  		$(this).parents("fieldset").addClass("is-validateEnabled");
	});

	/* Enable validation of all inputs once form is submitted */
	$("#TopUpForm").on("btnSubmit", function(event) 
	{
  		event.preventDefault();
  		if( $("#TopUpForm input:invalid").length ) 
  		{
    		$("fieldset").addClass("is-validateEnabled");
    		$("input:invalid").first().focus();
  		} 
  		else 
  		{
			document.TopUpForm.action = 'submitTopUpPayment.php';
  		}
	})
	
	/* Enable validation of all inputs once form is submitted */
	$("#DebitForm").on("btnSubmit1", function(event) 
	{
  		event.preventDefault();
  		if( $("#DebitForm input:invalid").length ) 
  		{
    		$("fieldset").addClass("is-validateEnabled");
    		$("input:invalid").first().focus();
  		} 
  		else 
  		{
			document.DebitForm.action = 'submitDirectDebit.php';
  		}
	})
	
	/* Enable validation of all inputs once form is submitted */
	$("#TopUpForm").on("myPayment_Submit", function(event) 
	{
  		event.preventDefault();
  		if( $("#TopUpForm input:invalid").length ) 
  		{
    		$("fieldset").addClass("is-validateEnabled");
    		$("input:invalid").first().focus();
  		} 
  		else 
  		{
			document.TopUpForm.action = saveCardDetails();
  		}
	})
</script>
<!-- Only Letters Validation -->
<script>
    function alphaOnly(event) {
        var key = event.keyCode;
        return ((key >= 65 && key <= 90) || (key >= 95 && key <= 122) || (key == 32));
    };
</script>
<!-- Only Numbers Validation -->
<script>
$(document).ready(function() {
    $("#card_number").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
});
$(document).ready(function() {
    $("#securitycodeid").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
});
$(document).ready(function() {
    $("#accountnumberInput").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
});
$(document).ready(function() {
    $("#sortcodeInput").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
});
</script>