<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Electric Ireland | Direct Debit Information</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- iPhone Home -->
	<link rel="apple-touch-icon" href="../../img/ElectricIreland/iphoneHome.png"/> 
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">

                <!-- Main content -->
                <section class="content invoice">                    
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-question-circle"></i> Direct Debit Information
                                <small class="pull-right"><?php echo date("d/m/Y");?></small>
                            </h2>                            
                        </div><!-- /.col -->
                    </div>
                    <div class="row">
                    	<br/>
                    	<h4><font color="009FDA">Your Rights:</font></h4>
                    	<br/>
						<p>Organisations using the Direct Debit Scheme go through a careful vetting process before they're authorised, 
                        and are closely monitored by the banking industry. The efficiency and security of Direct Debit is monitored 
            	        and protected by your own bank or building society.The Direct Debit Guarantee applies to all Direct Debits. 
                    	It protects you in the rare event that there is an error in the payment of your Direct Debit*. </p>
						<br/>
						<h4><font color="009FDA">Direct Debit Guarantee:</font></h4>
						<br/>
						<p>The Guarantee is offered by all banks and building societies that accept instructions to pay Direct Debits
                        If there are any changes to the amount, date or frequency of your Direct Debit the organisation will notify you
                        (normally 10 working days) in advance of your account being debited or as otherwise agreed. If you request the 
                        organisation to collect a payment, confirmation of the amount and date will be given to you at the time of the 
                        request</p>
						<br/>
						<p>If an error is made in the payment of your Direct Debit, by the organisation or your bank or building society, 
                        you are entitled to a full and immediate refund of the amount paid from your bank or building society If you 
                        receive a refund you are not entitled to, you must pay it back when the organisation asks you to You can cancel
                        a Direct Debit at any time by simply contacting your bank or building society. Written confirmation may be required. 
                        Please also notify the organisation. </p>
                        </br>
                        <p><b>* The Guarantee covers Direct Debit payments. It cannot be used to address contractual disputes between you and 
                        the billing organisation.</b></p>
                        </br>
                        <img src="../../img/ElectricIreland/directdebit.png" style="width:100px;height:100px;">      
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>