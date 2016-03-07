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
        <!-- Radio Buttons -->
        <link href="../../css/radio.css" rel="stylesheet" type="text/css" />

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
                <img src="../../img/ElectricIreland/brand_logo.png" height="45" />
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
                                <span class="label label-warning">2</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 2 alerts</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-gbp"></i> Direct Debit Due 10/12/15
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Energy Usage Exceeding Set Limit
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
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
                        <form name="TopUpForm" id="TopUpForm" autocomplete="off" method="post" action="#!">
                        	<body class="skin-blue">
                        	
    						<!-- Top Up Amount -->
                            <div class="form-group"> 
                            <br/>                        
                                <h5 class="text-center"><font color="009FDA">How Much Would You Like To Top-Up? *</font></h5>
                                <div class="form-group text-center">
                                
                                <fieldset class="question">
                                <div class="toggle_radio">
    								<input type="radio" checked class="toggle_option" required id="first_toggle" name="pricetype">
    								<input type="radio" class="toggle_option" required id="second_toggle" name="pricetype">
    								<input type="radio" class="toggle_option" required id="third_toggle" name="pricetype">
    								<input type="radio" class="toggle_option" required id="fourth_toggle" name="pricetype">
    								<label for="first_toggle"><p class="day">£25 </p></label>
    								<label for="second_toggle"><p class="day">£50 </p></label>
    								<label for="third_toggle"><p class="day">£75 </p></label>
   								 	<label for="fourth_toggle"><p class="day">£100 </p></label>
    								<div class="toggle_option_slider">
    								</div>
    							</div>
    							</fieldset>
                                    <div class="box-footer">
                                    </div>
                                </div>
                                
                            </div>
                            
                            <!-- Payment Type -->
                            <div class="form-group">
                                <h5 class="text-center"><font color="009FDA">How Would You Like To Pay? *</font></h5>
                                <div class="text-center">
                                <fieldset class="question">
                                    <label><input type="radio" name="cardtype" id="cardtype" class="minimal-blue" value="MasterCard" required/><img src="../../img/credit/mastercard5.png" style="width:52px;height:32px;" /></label>
                                    <label><input type="radio" name="cardtype" id="cardtype" class="minimal-blue" value="Maestro" required/><img src="../../img/credit/maestro.png" style="width:52px;height:32px;" /></label>
                                    <label><input type="radio" name="cardtype" id="cardtype" class="minimal-blue" value="Visa" required /><img src="../../img/credit/visa5.png" style="width:52px;height:32px;" /></label>
                                    <label><input type="radio" name="cardtype" id="cardtype" class="minimal-blue" value="Visa-Electron" required /><img src="../../img/credit/visa-electron.png" style="width:52px;height:32px;" /></label>
                                    <label><input type="radio" name="cardtype" id="cardtype" class="minimal-blue" value="American-Express" required /><img src="../../img/credit/american-express1.png" style="width:52px;height:32px;" /></label>
                                </fieldset>
                                    <div class="box-footer">
                                    </div>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="row">
                                	<!-- Cardholders Name -->
                                    <div class="col-xs-6 text-center">
                                        <h5><font color="009FDA">Card Holder's Name *</font></h5>
                                        <fieldset class="question">
                                        <input id="cardholderInput" name="cardholderid" type="text" class="Input" placeholder="Enter Card Holder's Name" onkeypress="return alphaOnly(event);" minlength="5" maxlength="40" required >
                                        </fieldset>
                                    </div>
									
									<!-- Card Number -->
                                    <div class="col-xs-6 text-center">
                                        <h5><font color="009FDA">Card Number *</font></h5>
                                        <fieldset class="question">
										<input type="tel" minlength="19" maxlength="19" id="cardnumberInput" value="" name="cardnumberid" onKeyup="addHyphen()" type="number" class="Input" placeholder="Enter Card Number" required />
                                    	</fieldset>
                                    </div>
								</div>
								
								<div class="row">
									<!-- Security Code -->
                                    <div class="col-xs-6 text-center">
                                        <h5><font color="009FDA">CVV *</font><a id="?" class= "letter image_fancybox" data-fancybox-group="group" href="../../img/credit/security-codes-cc.jpg">  ?</a></h5>
                                        <fieldset class="question">
                                        <input id="securitycodeInput" name="securitycodeid" type="tel" minlength="3" maxlength="3" class="Input" placeholder="Enter Security Code" required >
                                    	</fieldset>
                                    </div>
								
									<!-- Expiry Date -->
                                    <div class="col-xs-6 text-center">
                                        <h5><font color="009FDA">Expiry Date *</font></h5>
                                        <fieldset class="question">                                            
    									<input 
    										id="input-datepicker"
           									required
           									name="expirydate3id"
           									class="Date Date-picker Input--noSpinner" 
           									type="month" 
           									min="<?php echo date('Y-m', strtotime(' + 0 days')); ?>" 
           									max="<?php echo date('Y-m', strtotime(' +  1825 days')); ?>" 
           									placeholder="mm-yyyy" 
           									data-date='{"buttonOnly": true}'
           								/>
           								</fieldset>
                                    </div>
								</div>
								<div class="row">
									<div class="col-xs-12 text-center">
										<br/>
										<!-- Top Up T&Cs -->
                            			<div class="checkbox">
                            			<fieldset class="question">
                                			<label><input name="terms1" id="terms1" type="checkbox" class="Input" required autofocus> I accept the </label>
                                            <a id="terms&condit" class= "letter fancybox" data-fancybox-group="group" href="terms&conditions.php"><font size="2">Terms & Conditions *</font></a>	 
                                		</fieldset>
                                		</div>
                                	</div>
								</div>
								<div class="row">
                                   <!-- Submit & Save Button -->
                                   <br/>
                                    <div class="col-xs-12 text-center">
                                    	<button class="btn btn-success" id="btnSubmit" name="btnSubmit" onclick="submitTopform();return true;"><i class="fa fa-check-circle-o"></i> Submit</button>
                                    	<button class="btn btn-success" onclick="saveTopform();return true;"><i class="fa fa-save"></i> Save Card Details</button>     
                                    </div>
								</div>
								<div class="row">
								<br/>
									<div class="col-xs-12 text-center">
										<label type="text" id="errorMessage_savePayment" name="errorMessage_savePayment" hidden style="color: red">Payment Details Already Saved</label>
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
                                    			<label><input type="radio" name="debittype" id="debittype" class="Input" value="£100" required/>£100</label>
                                    			<label><input type="radio" name="debittype" id="debittype" class="Input" value="£250" required/>£250</label>
                                    			<label><input type="radio" name="debittype" id="debittype" class="Input" value="£500" required/>£500</label>
                                    			<label><input type="radio" name="debittype" id="debittype" class="Input" value="£1000" required/>£1000</label>
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
                                        		<input id="accountnameInput" name="accountnameid" type="text" class="Input" placeholder="Enter Account Name" onkeypress="return alphaOnly(event);" minlength="5" maxlength="40" required>
                                    		    </fieldset>
                                    		</div>
											
											<!-- Direct Debit Sort Code -->
                                    		<div class="col-xs-6 text-center">
                                        		<h5><font color="009FDA">Sort Code *</font></h5>
                                        		<fieldset class="question">
                                        		<input id="sortcodeInput" name="sortcodeid" type="tel" minlength="8" maxlength="8" class="Input" onKeyup="addHyphen()" placeholder="Enter Sort Code" required>
                                        		</fieldset>
                                    		</div>
										</div>
										
										<div class="row">
											<!-- Direct Debit Account Number -->
                                    		<div class="col-xs-6 text-center">
                                        		<h5><font color="009FDA">Account Number *</font></h5>
                                        		<fieldset class="question">
                                        		<input id="accountnumberInput" name="accountnumberid" type="tel" minlength="11" maxlength="11" class="Input" onKeyup="addHyphen()" placeholder="Enter Account Number" required>
                                        		</fieldset>
                                    		</div>
									
											<!-- Direct Debit T&Cs -->
                                    		<div class="col-xs-6 text-center">
                                    			<br/>
                            					<div class="checkbox">
                            					<a id="debitinfo" class= "letter fancybox" data-fancybox-group="group" href="DirectDebitInformation.php"><font size="2">Direct Debit Information</font></a>
                            					<fieldset class="question">
                                            		<label><input name="terms" id="terms" type="checkbox" class="Input" required autofocus> I accept the </label>
                                            		<a id="terms&condit" class= "letter fancybox" data-fancybox-group="group" href="terms&conditions.php"><font size="2">Terms & Conditions *</font></a>
                                            	</fieldset>
                                       			 </div>
                                    		</div>
                                    	</div>
                                    	<div class="row">
                                    	<br/>
                                    		<!-- Direct Debit Submit Button -->
                                    		<div class="col-xs-12 text-center">
                                    			<button class="btn btn-success" id="btnSubmit1" name="btnSubmit1" onclick="submitDebitform();return true;"><i class="fa fa-check-circle-o"></i> Submit</button>
                                    			<button class="btn btn-success" disabled onclick=""><i class="fa fa-edit"></i> Edit</button>
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
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal'
        });
        	//Blue color scheme for iCheck
        	$('input[type="checkbox"].minimal-blue, input[type="radio"].minimal-blue').iCheck({
        	checkboxClass: 'icheckbox_minimal-blue',
        	radioClass: 'iradio_minimal-blue'
        });
    });
    </script>
</body>
</html>



<!-- Form Actions -->
<script>
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
$('#cardnumberInput').keyup(function () {
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
	$("#TopUpForm .Input, #TopUpForm .Date, #TopUpForm .Datalist, #DebitForm .Input, #DebitForm .Date, #DebitForm .Datalist").blur( function() 
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
    $("#cardnumberInput").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
});
$(document).ready(function() {
    $("#securitycodeInput").keypress(function(event) {
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