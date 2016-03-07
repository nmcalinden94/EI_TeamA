<!DOCTYPE html>
<?php
session_start(); 
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
        <title>Electric Ireland | My Account</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- InputMask -->
		<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    	<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    	<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- Card Type Validation -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    	<script src="js/js-creditcardvalidator/jquery.creditCardValidator.js"></script>
    	<script type='text/javascript'>var $jq = jQuery.noConflict();</script>
		<!-- Validation -->
		<link href="validationRequiredField.css" rel="stylesheet" type="text/css" />
		<!-- Postcode -->
		<script src="jspostcode.js" type="text/javascript"></script>	
		<!-- globals -->
		<script src="js/EI/EI_StatementExample.js" type="text/javascript"></script>
		
			<!-- Sweet Alert -->
    <script src="js/sweetalert/dist/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="js/sweetalert/dist/sweetalert.css">
		
    </head>	
	<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="img/ElectricIreland/brand_logo2.png" height="45" />
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
                            <i class="fa fa-bar-chart-o"></i>
                            <span>Energy Usage</span>
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
                    <li class="active">
                        <a href="myaccount.php">
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
                    My Account
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">My Account</li>
                </ol>
            </section>
			
			 <!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active" onclick="disableMyAccountEditing()">
					<a href="#main_Details" role="tab" data-toggle="tab">
						<i class="fa fa-info-circle"></i> Account Details
					</a>
				</li>
				<li onclick="disableMyPaymentEditing()">
					<a href="#payment_Details" role="tab" data-toggle="tab">
						<i class="fa fa-credit-card"></i> Payment Details
					</a>
				</li>
			</ul>
				
			<!-- Tab panes -->
    		<div class="tab-content">
      			<div class="tab-pane fade active in" id="main_Details">
            		<!-- Main content -->
            		<section class="content">
						<div class ="col-md-6">
							<!-- general form elements disabled -->
                    		<div class="box box-primary">                   
                        		<div class="box-body" style="overflow-y: auto;">
								<br>
                					<div class="form-group">
										<div class="col-md-4">
											<label type="text"><font color="009FDA">Account Number: </font><label>
										</div>
										<div class="col-md-6">
											<fieldset class="question">
                    						<input type="text" id="my_AccountNo" name="my_AccountNo" minlength="8" maxlength="8" value="<?php require_once 'userDetails.php'; echo $myAccount_No ?>" onkeypress="return isNumber(event)" class="InputAccount" readonly />
                							</fieldset>
										</div>
									</div>
									<br>
               						 <div class="form-group">
										<div class="col-md-4">
											<label type="text"><font color="009FDA">MPRN: </font><label>
										</div>
										<div class="col-md-6">
											<fieldset class="question">
                    							<input type="text" id="my_MPRN" name="my_MPRN" minlength="11" maxlength="11" value="<?php require_once 'userDetails.php'; echo $myAccount_MPRN ?>" onkeypress="return isNumber(event)" class="InputAccount" readonly />
                							</fieldset>
										</div>
									</div>
               						<br><br>
			   						<div class="col-md-12 text-center">
                                        <a class= "btn btn-success" id="edit_MyAccountPassword" onclick="showPasswordBox()">Change Password</a>
                                    </div>
                            </div>
                        </div>
						
						<!-- Change Password Div -->
						<div id="changePassword" class="box box-primary" style="visibility: hidden;">                   
                        	<div class="box-body" style="overflow-y: auto;">
							<br>
                				<div class="form-group">
									<div class="col-md-4">
										<label type="text"><font color="009FDA">Current Password: </font><label>
									</div>
									<div class="col-md-6">
										<fieldset class="question">
                    					<input type="password" id="my_Password" name="my_Password"  class="InputAccount" />
                						</fieldset>
									</div>
								</div>
								<br>
                				<div class="form-group">
									<div class="col-md-4">
										<label type="text"><font color="009FDA">New Password: </font><label>
									</div>
								<div class="col-md-6">
									<fieldset class="question">
                    				<input type="password" id="my_NewPass" name="my_NewPass" class="InputAccount" />
                					</fieldset>
								</div>
							</div>
               				<br><br>
			   				<div class="form-group">
								<div class="col-md-4">
									<label type="text"><font color="009FDA">Re-type New: </font><label>
								</div>
								<div class="col-md-6">
									<fieldset class="question">
                    				<input type="password" id="my_ConfirmPass" name="my_ConfirmPass" class="InputAccount" />
                					</fieldset>
								</div>
							</div>
							<br><br>
							<div class="col-md-12 text-center">
								<label type="text" id="errorMessage_myPassword" name="errorMessage_myPassword" style="color: red"></label>
							</div>
							<br><br>
			   				<div class="col-md-12 text-center">
                                <a class= "btn btn-success" onclick="editPassword()" id="edit_MyAccountPassword">Submit</a>
								<a href="#" id="myPassword_Cancel" onclick="closePasswordBox()" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
				</div>
                <!-- right column -->
                <div class="col-md-6">
				<!-- general form elements disabled -->
                    <div class="box box-primary">                   
                        <div class="box-body" style="overflow-y: auto;">
							<div class="form-group">
								<div class="col-md-4">
									<label type="text"><font color="009FDA">Business Name: </font><label>
								</div>
								<div class="col-md-6">
									<fieldset class="question">
       								<input type="text" id="my_Business" name="my_Business" value="<?php require_once 'userDetails.php'; echo $myAccount_Business ?>" class="InputAccount" readonly />
                					</fieldset>
								</div>
							</div>
				 			<div class="form-group">
								<div class="col-md-4">
									<label type="text"><font color="009FDA">Postcode: </font><label>
								</div>
								<div class="col-md-6">
									<fieldset class="question">
                    				<input type="text" id="my_Postcode" name="my_Postcode" value="<?php require_once 'extraDetails.php'; echo $my_Postcode ?>" class="InputAccount" readonly />
                					</fieldset>
								</div>
							</div>
							<br><br>
                			<div class="form-group">
								<div class="col-md-4">
									<label type="text"><font color="009FDA">Business Address: </font><label>
								</div>
								<div class="col-md-6">
									<fieldset class="question">
                    				<input type="text" id="my_Address" name="my_Address" value="<?php require_once 'extraDetails.php'; echo $my_Address ?>" class="InputAccount" readonly />
									</fieldset>
                				</div>
							</div>
							<br><br>
                			<div class="form-group">
								<div class="col-md-4">
									<label type="text"><font color="009FDA">City: </font><label>
								</div>
								<div class="col-md-6">
									<fieldset class="question">
                    				<input type="text" id="my_City" name="my_City" value="<?php require_once 'extraDetails.php'; echo $my_City ?>" class="InputAccount" readonly />
									</fieldset>
                				</div>
							</div>
							<br><br>
                			<div class="form-group">
								<div class="col-md-4">
									<label type="text"><font color="009FDA">E-mail: </font><label>
								</div>
								<div class="col-md-6">
									<fieldset class="question">
                    				<input type="text" id="my_Email" name="my_Email" value="<?php require_once 'extraDetails.php'; echo $my_Email ?>" class="InputAccount" readonly />
									</fieldset>
                				</div>
							</div>
               				<br><br>	   
			   				<div class="col-md-12 text-center">
								<label type="text" id="errorMessage_myAccount" name="errorMessage_myAccount" style="color: red"></label>
							</div>
			   				<br><br>
			   				<div class="col-md-12 text-center">
                            	<a href="#" id="edit_MyAccountDetails" onclick="enableMyAccountEditing()" class="btn btn-success">Edit</a>
								<a href="#" type="submit" id="myAccount_Submit" class="btn btn-success" onclick="validation_MyAccountDetails()" disabled>Submit</a>
								<a href="#" id="myAccount_Cancel" onclick="disableMyAccountEditing()" class="btn btn-danger" disabled>Cancel</a>
                 			</div>
                        </div>
                    </div>
                </div>
            </section>
		</div>
		
		<div class="tab-pane fade" id="payment_Details">
            <!-- Main content -->
            <section class="content">
				<div class ="col-md-3">
				</div>
                <!-- right column -->
                <div class="col-md-6">
                    <!-- general form elements disabled -->
                    <div class="box box-primary">                   
                        <div class="box-body" style="overflow-y: auto;">
                			<div class="form-group">
								<div class="col-md-4">
									<label type="text"><font color="009FDA">Card Holders Name: </font><label>
								</div>
								<div class="col-md-6">
                    				<input id="cardholderid" name="cardholderid" type="text" class="InputAccount" placeholder="MR JOHN SMITH" onkeypress="return alphaOnly(event);" minlength="5" maxlength="40" value="<?php require_once 'userDetails.php'; echo $loadCard_Name ?>" readonly >
                				</div>
							</div>
							<br><br>
                			<div class="form-group">
								<div class="col-md-4">
									<label type="text"><font color="009FDA">Card Number: </font><label>
								</div>
								<div class="col-md-6">
                    				<input type="tel" minlength="19" maxlength="19" name="card_number" id="card_number" onKeyup="addHyphen()" type="number" class="InputAccount" placeholder="0000-0000-0000-0000" value="<?php require_once 'userDetails.php'; echo $loadCard_Number ?>" readonly>
                				</div>
							</div>
							<br><br>
                			<div class="form-group">
								<div class="col-md-4">
									<label type="text"><font color="009FDA">Expiry Date: </font><label>
								</div>
								<div class="col-md-6">
                    				<input 
    								id="expirydate3id"
    								readonly
           							name="expirydate3id"
           							class="Date Date-picker Input--noSpinner" 
           							type="month" 
           							style="background-color: #e3e3e3;"
           							min="<?php echo date('Y-m', strtotime(' + 0 days')); ?>" 
           							max="<?php echo date('Y-m', strtotime(' +  1825 days')); ?>" 
           							placeholder="mm-yyyy" 
           							data-date='{"buttonOnly": true}'
           							value="<?php require_once 'userDetails.php'; echo $loadCard_Date ?>"
           							/>
                				</div>
							</div>
               				<br><br>
			   				<div class="form-group">
								<div class="col-md-4">
									<label type="text"><font color="009FDA">CVV: </font><label>
								</div>
								<div class="col-md-3">
                    				<input id="securitycodeid" name="securitycodeid" type="password" minlength="3" maxlength="3" class="InputAccount" placeholder="000" value="<?php require_once 'userDetails.php'; echo $loadCard_Code ?>" readonly >
                				</div>
							</div>
               				<br><br>
			   				<div class="col-md-12 text-center">
								<label type="text" id="errorMessage_myPayment" name="errorMessage_myPayment" style="color: red"></label>
							</div>		   
			   				<br><br>
			   				<div class="col-md-12 text-center">
                                <a href="#" id="edit_MyPaymentDetails"  onclick="enableMyPaymentEditing()" class="btn btn-success">Edit</a>
								<a href="#" type="submit" id="myPayment_Submit" onclick="validation_MyPaymentDetails()" class="btn btn-success" disabled>Submit</a>
								<a href="#" id="myPayment_cancel" onclick="disableMyPaymentEditing()" class="btn btn-danger" disabled>Cancel</a>
                            </div>
                        </div>
                        </div>
                    </div>
               </section>
			</div>	
		</div>
	</aside>
</div>
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

    
    <!-- jQuery 2.0.2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="js/AdminLTE/app.js" type="text/javascript"></script>
    <!-- My Account JS -->
	<script src="myAccount_edit.js" type="text/javascript"></script>
	
	
	<!-- Sweet Alert -->
    <script>
        function successMessage(){
            var form = this;
            //e.preventDefault();
                    swal({
                        title: 'Success!',
                        text: 'Password has been updated!',
                        type: 'success',
                        timer: 3000,   
                        showConfirmButton: false
                    });
        };
		
		function failMessage(){
            var form = this;
            //e.preventDefault();
                   swal("Cancelled", "Your password hasn't been changed", "error");
        };
    </script>
	
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
</body>
</html>

<!-- Add Hyphen -->
<script>
function addHyphen() {
$('#card_number').keyup(function () {
    var foo = $(this).val().split("-").join(""); // remove hyphens
    if (foo.length > 0) {
        foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
    }
    $(this).val(foo);
});
}
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
</script>