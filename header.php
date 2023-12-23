<?php
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
session_start();
$dt = date("Y-m-d");
$tim = date("H:i:s");
$dttim = date("Y-m-d H:i:s");
include("dbconnection.php");
//Default Admin record starts here
$sqldesignation ="SELECT * FROM designation";
$qsqldesignation = mysqli_query($con,$sqldesignation);
echo mysqli_error($con);
if(mysqli_num_rows($qsqldesignation) == 0)
{
	$sql = "INSERT INTO designation(designation_id,designation_type,status)values('1','Administrator','Active')";
	$qsql = mysqli_query($con,$sql);
}
//Default Admin record ends here
//Default cop record starts here
$sqldesignation ="SELECT * FROM cop";
$qsqldesignation = mysqli_query($con,$sqldesignation);
echo mysqli_error($con);
if(mysqli_num_rows($qsqldesignation) == 0)
{
	$sql = "INSERT INTO cop(cop_id,designation_id,cop_name,login_id,password,status)values('1','1','Administrator','admin','adminadminadmin','Active')";
	$qsql = mysqli_query($con,$sql);
}
//Default cop record ends here
if(isset($_POST['btncomplogin']))
{
	$sql ="SELECT * FROM complaint WHERE email_id='$_POST[compemailid]' and password='$_POST[comppassword]' and status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsql) >= 1)
	{
		$rspro = mysqli_fetch_array($qsql);
		$_SESSION['complaint_id'] = $rspro['complaint_id'];
		echo "<script>window.location='compaccount.php';</script>";
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials..');</script>";
	}
}
if(isset($_POST['btncoplogin']))
{
	$sql ="SELECT * FROM cop WHERE login_id='$_POST[coploginid]' and password='$_POST[coppassword]' and status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsql) >= 1)
	{
		$rspro = mysqli_fetch_array($qsql);
		$_SESSION['cop_id'] = $rspro['cop_id'];
		$_SESSION['designation_id'] = $rspro['designation_id'];
		echo "<script>window.location='dashboard.php';</script>";
	}
	else
	{
echo "<script>alert('You have entered invalid login credentials..');</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ECOPULSE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="assets/favicon/logo2.ico">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
        
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/rev_slider/settings.css">
        <link rel="stylesheet" href="assets/css/rev_slider/layers.css">
        <link rel="stylesheet" href="assets/css/rev_slider/navigation.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/lineicon.css">
        <link rel="stylesheet" href="assets/css/lightbox.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/css/owl.theme.css">
        <link rel="stylesheet" href="assets/css/owl.transitions.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/css/fixedColumns.dataTables.min.css">
    </head>
    <body>
    <div id="container">
        <!-- Start Top Header Section -->
        <section class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <ul class="social-icons">

	<li class="drop"><a href="about.php">About</a></li>
	<li><a href="contact.php">Contact</a></li>
	
                    </div>
                    <div class="col-md-7">
                        <div class="contact-info">
						
                        <ul class="social-icons">
	<li>
		<a>SDP Group Project - KU Top Up, B001</a>
	</li>
		  
	<li>|</li>
	<li><a target="_blank" href="#"><i class="fa fa-facebook"></i></a></li>
	<li><a target="_blank" href="#"><i class="fa fa-twitter"></i></a></li>
	<li><a target="_blank" href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Top Header Section -->

        <!-- Start Header & Navigation Section -->
        <header class="clearfix" id="header">
            <!-- Static navbar -->
            <nav class="navbar navbar-default">
                 
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img alt="" src="assets/images/logo/ecopulse.png"></a>
                    </div>
                    <div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right">
<?php
	if(isset($_SESSION['complainer_id']))
	{
?>
	<li class="drop"><a class="active" href="index.php">Home</a></li>
	<li><a href='complaint_registration.php'>Submit a Report</a></li>	
	<li class="drop"><a href="#">Profile</a> 
		<ul class="drop-down">
			<li><a href="complainerprofile.php">Update Profile</a></li>
			<li><a href="complainerchangepassword.php">Change password</a></li>
		</ul>
	</li>
	<li class="drop"><a href="#">Report</a> 
		<ul class="drop-down">
			<li><a href="viewcomplaint.php">View Crime Reports</a></li>
			<li><a href="viewfir.php">First Information Report</a></li>
			<li><a href="viewprodoc.php">Prosecution Document</a></li>
			<li><a href="viewcrime_report.php">Law Infringement Report</a></li>
			<li><a href="viewlegalcase.php">Legal Report</a></li>
		</ul>
	</li>
	<li><a href="logout.php">Logout</a></li>
<?php
	}
	else if(isset($_SESSION['cop_id']))
	{
?>
	<li class="drop"><a class="active" href="dashboard.php">Home</a></li>		
	<li class="drop"><a href="#">Reports</a> 
		<ul class="drop-down">
			<li><a href="viewcomplaint.php">View Reports</a></li>
			<li><a href="complainer.php">Add User</a></li>
			<li><a href="viewcomplainer.php">View Users</a></li>
		</ul>
	</li>
	
	<li class="drop"><a href="#">First Information Report</a> 
		<ul class="drop-down">
			<li><a href="firregistration.php">Submit Report</a></li>
			<?php /* <li><a href="fir.php">Add FIR</a></li> */ ?>
			<li><a href="viewfir.php">View Report</a></li>
		</ul>
	</li>
	
	<li class="drop"><a href="#">Prosecution Document</a> 
		<ul class="drop-down">
			<li><a href="selectfirtochargesheet.php">Add Document</a></li>
			<li><a href="viewprodoc.php">View Document</a></li>
		</ul>
	</li>
	
	<li class="drop"><a href="#">Crime Report</a> 
		<ul class="drop-down">
			<li><a href="selectchargesheetforcrime.php">Add Prosecution Report</a></li>
			<li><a href="viewcrime_report.php">Law Infringement Report</a></li>
		</ul>
	</li>
	
	<li class="drop"><a href="#">Law Infringement Report</a> 
		<ul class="drop-down">
			<li><a href="selectlegalcase.php">Add Report</a></li>
			<li><a href="viewlegalcase.php">View Report</a></li>
		</ul>
	</li>
<?php
if($_SESSION['designation_id'] == 1)	
{
?>
	<li class="drop"><a href="#">Office</a> 
		<ul class="drop-down">
			<li><a href="officer.php">Add Officer</a></li>
			<li><a href="viewofficer.php">View Officer</a></li>
			<li><a href="Offices.php">Add Office</a></li>
			<li><a href="viewoffice.php">View Office</a></li>
			<li><a href="role.php">Add Role</a></li>
			<li><a href="viewrole.php">View Role</a></li>
		</ul>
	</li>	
	<li class="drop"><a href="#">Manage Areas</a> 
		<ul class="drop-down">
			<li><a href="city.php">Add City</a></li>
			<li><a href="viewcity.php">View City</a></li>
			<li><a href="state.php">Add District</a></li>
			<li><a href="viewstate.php">View Districts</a></li>
		</ul>
	</li>
<?php
}
?>
	<li class="drop"><a href="#">Profile</a> 
		<ul class="drop-down">
			<li><a href="officerprofile.php">Update Profile</a></li>
			<li><a href="officerpass.php">Change Password</a></li>
		</ul>
	</li>	
	<li><a href="logout.php">Logout</a></li>	
<?php
	}
	else
	{
?>
	<li class="drop"><a href="index.php">Home</a></li>
	<?php
		if(isset($_SESSION['complainer_id']))
		{
		echo "<li><a href='complaint_registration.php'>Register a Complaint</a></li>";
		}
		else
		{
		echo "<li><a href='#' onclick='alert(`Kindly login before registering complaint..`);'>Register a Complaint</a></li>";			
		}	
	?>
	<li class="drop"><a href="#">Login</a>
    <ul class="drop-down">
			<li><a href="complainerlogin.php">Civilian Login</a></li>
			<li><a href="officerlog.php">Officer Login</a></li>
		</ul></li>
	<li class="drop"><a href="complainerregister.php" target="_blank">Register</a></li>
<?php
	}
?>
</ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- End Header -->
        <!-- End Header & Navigation Section -->
<style>
.avatar{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    left: calc(50% - 50px);
}
</style>