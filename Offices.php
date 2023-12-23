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
		$sql ="UPDATE station SET station='$_POST[station]',state_id='$_POST[state_id]',city_id='$_POST[city_id]',station_addresss='$_POST[station_addresss]',contact_no='$_POST[contact_no]',img='$_POST[img]',description='$_POST[description]',status='$_POST[status]' WHERE station_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('station record updated successfully');</script>";
		}		
	}
	//Update Statement ends here
	//Insert statemetn starts here
	else
	{
		$sql ="INSERT INTO station (station, state_id, city_id, station_addresss, contact_no, img, description, status)values('$_POST[station]','$_POST[state_id]','$_POST[city_id]','$_POST[station_addresss]','$_POST[contact_no]','$_POST[img]','$_POST[description]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('station record inserted successfully');</script>";
			echo "<script>window.location='station.php';</script>";
		}
	}
}	
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM station WHERE station_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>   
        <!-- Start Breadcrumb Section -->
        <section class="breadcrumb-section parallax" style="background-image:url(assets/images/bg/Simple_Environment.jpeg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1>Offices</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->


<form method="post" action="" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Office</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">Office</div>
                            <div class="col-md-10">
                                <input type="text" name="station" id="station" class="form-control" value="<?php echo $rsedit['station']; ?>">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-2">District</div>
                            <div class="col-md-10">
                                <select name="state_id" id="state_id" class="form-control">
                                    <option value="">Select District</option>
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
                        </div><br>

                        <div class="row">
                            <div class="col-md-2">City</div>
                            <div class="col-md-10">
                                <select name="city_id" id="city_id" class="form-control">
                                    <option value="">Select City</option>
                                    <?php
                                    $sqlcity = "SELECT * FROM city WHERE status='Active'";
                                    $qsqlcity = mysqli_query($con, $sqlcity);
                                    while ($rscity = mysqli_fetch_array($qsqlcity)) {
                                        if ($rsstate['city_id'] == $rsedit['city_id']) {
                                            echo "<option value='$rscity[city_id]' selected>$rscity[city]</option>";
                                        } else {
                                            echo "<option value='$rscity[city_id]'>$rscity[city]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-2">Address</div>
                            <div class="col-md-10">
                                <textarea name="station_addresss" id="station_addresss" class="form-control"><?php echo $rsedit['station_addresss']; ?></textarea>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-2">Contact Number</div>
                            <div class="col-md-10">
                                <input type="text" name="contact_no" id="contact_no" class="form-control">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-2">Image</div>
                            <div class="col-md-10">
                                <input type="file" name="img" id="img" class="form-control">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-2">Description</div>
                            <div class="col-md-10">
                                <textarea name="description" id="description" class="form-control"><?php echo $rsedit['description']; ?></textarea>
                            </div>
                        </div><br>

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
                        </div><br>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <input type="submit" name="submit" id="submit" class="form-control btn btn-danger" style="width: 250px;">
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

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