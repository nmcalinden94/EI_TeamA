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
    <title>Electric Ireland | Contact Us</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
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
        <a href="../index.php" class="logo">
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

                    <li class="active">
                        <a href="contact_us.php">
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
                        <small>Contact Us</small>
                    </h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Contact Us</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">       
                    <div class="col-md-12">
                        <div class="box box-success">
                            <section id="contact-page">
        						<div class="container">
            					<div class="row contact-wrap"> 
                					<div class="status alert alert-success" style="display: none"></div>
                						<form id="main-contact-form" autocomplete="off" class="contact-form" name="main-contact-form" method="post" action="send_form_email.php">
                    					<div class="col-sm-5 col-sm-offset-1">
                        					<div class="form-group">
                            					<h5><font color="009FDA">Name *</font></h5>
                            					<fieldset class="question">
                            					<input type="text" name="name" class="InputContact" placeholder="Enter Your Name" onkeypress="return alphaOnly(event);" minlength="5" maxlength="40" required>
                        					</div>
                        				<div class="form-group">
                            				<h5><font color="009FDA">Email *</font></h5>
                            				<fieldset class="question">
                            				<input type="email" name="email" class="InputContact" placeholder="Enter Your E-Mail Address" minlength="3" maxlength="50" required>
                        				  </fieldset>
                        				</div>
                        				<div class="form-group">
                            				<h5><font color="009FDA">Phone *</font></h5>
                            				<fieldset class="question">
                            				<input type="tel" name="telephone" id="telephone" class="InputContact" onKeyup="addHyphen()" placeholder="Enter Your Phone Number" minlength="10" maxlength="23" required>
                        					</fieldset>
                        				</div>
                        				<div class="form-group">
                            				<h5><font color="009FDA">Business Name</font></h5>
                            				<fieldset class="question">
                            				<input type="text" name="company" class="InputContact" style="background-color:#e3e3e3;" readonly value="<?php 
											require_once '../../DB_connect.php';
											echo $_SESSION['business'];?>">
                        					</fieldset>
                        				</div>                        
                    			</div>             			
                    			<div class="col-sm-5">
                        			<div class="form-group">
                            			<h5><font color="009FDA">Subject *</font></h5>
                            			<fieldset class="question">
                            			<select id="soflow" name="subjectname" required>
                            				<option  style="display:none;" value="" disabled selected>Select A Subject</option>
        									<option>General</option>
        									<option>Fault Reporting</option>
        									<option>Pay As You Go</option>
        									<option>App Issues</option>
        									<option>Services</option>
        									<option>Sales Support</option>
										</select>
										</fieldset>                 			
                        			</div>
                        				
                        			<div class="form-group">
                            			<h5><font color="009FDA">Message * </font><span style="font-size: 70%" id='remainingC'></span></h5>
                            			<fieldset class="question">
                            			<textarea name="message" id="message" required class="InputContact" placeholder="Enter A Message" rows="8" minlength="5" maxlength="500" ></textarea>
                        				</fieldset>
                        			</div>                        
                        			<div class="form-group">
                            			
                        			</div>
                    			</div>
                    			<div class="col-xs-12 text-center">
                    				<button name="btnSubmit" id="btnSubmit" class="btn btn-success"><i class="fa fa-check-circle-o"></i> Submit</button>
                                </div>
                                <div class="col-xs-12 text-center">
                    				<br/>
                                </div>
                				</form> 
            				</div><!--/.row-->
        				</div><!--/.container-->
    				</section><!--/#contact-page-->
                </div>
            </div>     
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="gmap-area">
            				<div class="container">
                				<div class="row">
                    				<div class="col-sm-5 text-center">
                        				<div class="gmap">
                            				<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?q=Bldg%202%2C%20Swift%20Square%2C%20Northwood%20Park%2C%20Dublin%209%2C%20Ireland&key=AIzaSyAnI-Rkqqg3PAzyKmRslIJenB0VosjEHr8"></iframe>
                        				</div>
                    				</div>
                    					<div class="col-sm-7 map-content">
                       						<ul class="row">
                            					<li class="col-sm-6">
                                					<address>
                                    					<h5><font color="009FDA">Head Office</font></h5>
                                    					<p>Bldg 2, Swift Square, Northwood Park,<br>
                                    					Dublin 9, Ireland</p>
                                    					<p><b>Phone:</b>+353 1 862 8350 <br>
                                    					<b>Postal Address:</b> Electric Ireland, PO Box 841, <br> 
                                    					South City Delivery Office, Cork.<br>
                                    					<b>International Contact Number:</b> 00353 1 8529534</p>
                                					</address>
                            					</li>
                            					<li class="col-sm-6">   					
                                					<address>
                                    					<h5><font color="009FDA">Service</font></h5>
                                    					<p><b>Phone:</b> 1850 372 372 <br>                                
                                    					<b>Opening Times:</b> 8am-8pm Mon - Sat <br>
                                    					<b>E-Mail:</b> service@electricireland.ie</p>
                                					</address>
                                					<address>
                                    					<h5><font color="009FDA">Sales</font></h5>
                                    					<p><b>Phone:</b> 1850 30 50 90 <br>                                
                                    					<b>Opening Times:</b> 8am-8pm Mon - Fri, 9am-5.30pm Sat <br>
                                    					<b>E-Mail:</b> sales@electricireland.ie</p>
                                					</address>
                                					<address>
                                    					<h5><font color="009FDA">Home Energy Services</font></h5>
                                    					<p><b>Phone:</b> 1850 30 50 85 <br>                                
                                    					<b>Opening Times:</b> 8am-6pm Mon - Fri <br>
                                    					<b>E-Mail:</b> homeservices@electricireland.ie</p>
                                					</address>
                            					</li>
                        					</ul>
                    					</div>
                					</div>
            					</div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col (right) -->
                </div><!-- /.row -->
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
                        				<li> <a href="../charts/usageCharts.php"> Energy Usage </a> </li>
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
                        				<li> <a href="contact_us.php"> Contact Us </a> </li>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
    <!-- Webshim Validation -->
    <script src="../../js/js-webshim/minified/polyfiller.js"></script>    
    <!-- Sweet Alert -->
    <script>
        document.querySelector('#main-contact-form').addEventListener('submit', function(e) {
            var form = this;
            e.preventDefault();
            swal({
                title: "Are you sure want to send?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, send!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {         
                if (isConfirm) {
                form.submit();
                    swal({
                        title: 'Success!',
                        text: 'Message has been sent!',
                        type: 'success',
                        timer: 9000,   
                        showConfirmButton: false
                    });
                    
                } else {
                    swal("Cancelled", "Your message hasn't been sent", "error");
                }
            });
        });
    </script> 
</body>
</html>
<script>
$('textarea').keypress(function(){

    if(this.value.length > 500){
        return false;
    }
    $("#remainingC").html("Remaining characters : " +(500 - this.value.length));
});
</script>
<!-- Input Masking -->
<script>
$('#telephone').keyup(function () {
    var foo = $(this).val().split("-").join(""); // remove hyphens
    if (foo.length > 0) {
        foo = foo.match(new RegExp('.{1,3}', 'g')).join("-");
    }
    $(this).val(foo);
});
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
	$("#main-contact-form .Input, #main-contact-form .Date, #main-contact-form .Datalist, #main-contact-form .InputContact, #main-contact-form select#soflow").blur( function() 
	{
  		$(this).parents("fieldset").addClass("is-validateEnabled");
	});

	/* Enable validation of all inputs once form is submitted*/
	$("#main-contact-form").on("submit", function(event) 
	{
  		event.preventDefault();
  		if( $("#main-contact-form input:invalid").length ) 
  		{
    		$("fieldset").addClass("is-validateEnabled");
    		$("input:invalid").first().focus();
  		} 
  		else 
  		{
    		$("#btnSubmit").attr("value","Submitting...");
    		$(this).submit();
  		}
	});
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
    $("#telephone").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
});
</script>