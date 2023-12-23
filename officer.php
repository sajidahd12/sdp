<?php
include("header.php");
if(isset($_POST['submit']))
{
	$filename = rand() . $_FILES["img"]["name"];
	move_uploaded_file($_FILES["img"]["tmp_name"],"imgofficers/".$filename);
	//Update Statement starts here
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE cop SET cop_name='$_POST[cop_name]',station_id='$_POST[station_id]',designation_id='$_POST[designation_id]'";
		if($_FILES["img"]["name"] != "")
		{
		$sql = $sql . ",img='$filename'";
		}
		$sql = $sql . ",cop_pofile='$_POST[cop_pofile]',gender='$_POST[gender]',contact_no='$_POST[contact_no]',email_id='$_POST[email_id]',login_id='$_POST[login_id]',password='$_POST[password]',status='$_POST[status]' WHERE cop_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Officer Profile updated successfully');</script>";
		}		
	}
	//Update Statement ends here
	//Insert statemetn starts here
	else
	{
		$sql ="INSERT INTO cop (cop_name,station_id,designation_id,img,cop_pofile,gender,contact_no,email_id,login_id,password,status)values('$_POST[cop_name]','$_POST[station_id]','$_POST[designation_id]','$filename','$_POST[cop_pofile]','$_POST[gender]','$_POST[contact_no]','$_POST[email_id]','$_POST[login_id]','$_POST[password]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Officer Record Inserted Successfully');</script>";
			echo "<script>window.location='officer.php';</script>";
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM cop WHERE cop_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>      
        <section class="breadcrumb-section parallax" style="background-image:url(assets/images/bg/Simple_Environment.jpeg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1>Officer Management</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<form method="post" action="" enctype="multipart/form-data">
    <!-- Start About Section -->
    <section class="pad-t100 pad-b70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Officer Registration</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">Officer Name</div>
                                <div class="col-md-10">
                                    <input type="text" name="cop_name" id="cop_name" class="form-control" value="<?php echo $rsedit['cop_name']; ?>">
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col-md-2">Station</div>
                                <div class="col-md-10">
                                    <select name="station_id" id="station_id" class="form-control">
                                        <option value="">Select Office</option>
                                        <?php
                                        $sqlstation = "SELECT * FROM station WHERE status='Active'";
                                        $qsqlstation = mysqli_query($con, $sqlstation);
                                        while ($rsstation = mysqli_fetch_array($qsqlstation)) {
                                            if ($rsstation['station_id'] == $rsedit['station_id']) {
                                                echo "<option value='$rsstation[station_id]' selected>$rsstation[station]</option>";
                                            } else {
                                                echo "<option value='$rsstation[station_id]'>$rsstation[station]</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col-md-2">Officer Role</div>
                                <div class="col-md-10">
                                    <select name="designation_id" id="designation_id" class="form-control">
                                        <option value="">Select Role</option>
                                        <?php
                                        $sqldesignation = "SELECT * FROM designation WHERE status='Active'";
                                        $qsqldesignation = mysqli_query($con, $sqldesignation);
                                        while ($rsdesignation = mysqli_fetch_array($qsqldesignation)) {
                                            if ($rsdesignation['designation_id'] == $rsedit['designation_id']) {
                                                echo "<option value='$rsdesignation[designation_id]' selected>$rsdesignation[designation_type]</option>";
                                            } else {
                                                echo "<option value='$rsdesignation[designation_id]'>$rsdesignation[designation_type]</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col-md-2">Image</div>
                                <div class="col-md-10">
                                    <input type="file" name="img" id="img" class="form-control">
                                    <?php
                                    if (isset($_GET['editid'])) {
                                        echo "<img src='imgofficers/$rsedit[img]' style='width: 150px; height: 175px;'>";
                                    }
                                    ?>
                                </div>
                            </div><br>

                            <!-- ... (remaining form fields) ... -->

                            <hr><br>

                            <div class="row">
                                <div class="col-md-12">
                                    <center><input type="submit" name="submit" id="submit" class="form-control btn btn-danger" style="width: 250px;"></center>
                                </div>
                            </div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->
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