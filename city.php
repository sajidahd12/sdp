<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE city SET city='$_POST[city]',state_id='$_POST[state_id]',description='$_POST[description]',status='$_POST[status]' WHERE city_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('city record updated successfully');</script>";
		}		
	}
	//Update Statement ends here
	//Insert statemetn starts here
	else
	{
		$sql ="INSERT INTO city (city,state_id,description,status)values('$_POST[city]','$_POST[state_id]','$_POST[description]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('City record inserted successfully');</script>";
			echo "<script>window.location='city.php';</script>";
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM city WHERE city_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
        <!-- Start Breadcrumb Section -->
        <section class="breadcrumb-section parallax" style="background-image: url(assets/images/bg/1_Cnb77NWpiIMBWgC9ChPW2w.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1>Manage Cities</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->


<!-- Start About Section -->
<form method="post" action="" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add New City</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">City</div>
                            <div class="col-md-10">
                                <input type="text" name="city" id="city" class="form-control" value="<?php echo $rsedit['city']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">District</div>
                            <div class="col-md-10">
                                <select name="state_id" id="state_id" class="form-control">
                                    <option value="">Select State</option>
                                    <?php
                                    $sqlstate = "SELECT * FROM state WHERE status='Active'";
                                    $qsqlstate = mysqli_query($con, $sqlstate);
                                    while ($rsstate = mysqli_fetch_array($qsqlstate)) {
                                        if ($rsstate['state_id'] == $rsedit['state_id']) {
                                            echo "<option value='$rsstate[state_id]' selected>$rsstate[state]</option>";
                                        } else {
                                            echo "<option value='$rsstate[state_id]'>$rsstate[state]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Description</div>
                            <div class="col-md-10">
                                <textarea name="description" id="description" class="form-control"><?php echo $rsedit['description']; ?></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Status</div>
                            <div class="col-md-10">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <?php
                                    $arr = array("Active", "Inactive");
                                    foreach ($arr as $val) {
                                        if ($val == $rsedit['status']) {
                                            echo "<option value='$val' selected>$val</option>";
                                        } else {
                                            echo "<option value='$val'>$val</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <input type="submit" name="submit" id="submit" class="form-control btn btn-danger" style="width: 250px;">
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End About Section -->

<style>
form {
    margin-top: 20px;
}

/* Panel styling */
.panel-primary {
    margin-top: 20px;
}

.panel-heading {
    background-color: #0C0;
    color: #fff;
}

.col-md-2 {
    color: #fff;
	font-weight:bold;
}

.col-md-12 {
    margin-bottom: 15px;
}

h4 {
    background-color: #0C0;
    color: #fff;
    padding: 10px;
    margin-top: 0;
}

.panel-title {
    font-size: 18px;
}

.panel-tabs {
    position: relative;
    bottom: 30px;
    clear: both;
    border-bottom: 1px solid transparent;
}

.panel-tabs > li {
    float: left;
    margin-bottom: -1px;
}

.panel-tabs > li > a {
    margin-right: 2px;
    margin-top: 4px;
    line-height: 0.85;
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
    color: #ffffff;
}

.panel-tabs > li > a:hover {
    border-color: transparent;
    color: #ffffff;
    background-color: transparent;
}

.panel-tabs > li.active > a,
.panel-tabs > li.active > a:hover,
.panel-tabs > li.active > a:focus {
    color: #fff;
    cursor: default;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    background-color: rgba(255, 255, 255, 0.23);
    border-bottom-color: transparent;
}

input[type="submit"] {
    height: 60px;
    width: 250px;
    margin-top: 20px;
    margin-bottom: 20px;
}

@media (max-width: 767px) {
    .panel-tabs {
        bottom: 0;
    }
}
</style>

<?php
include("footer.php");
?>     