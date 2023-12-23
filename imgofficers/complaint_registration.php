<?php
include("header.php");
if(isset($_POST['submit']))
{
	$photo_evidence  = rand(). $_FILES['photo_evidence']['name'];
	move_uploaded_file($_FILES['photo_evidence']['tmp_name'],"imgphoto_evidence/".$photo_evidence);
	$video_evidence =  rand() . $_FILES['video_evidence']['name'];
	move_uploaded_file($_FILES['video_evidence']['tmp_name'],"imgvideo_evidence/".$video_evidence);
	$sql ="INSERT INTO complaint (station_id, state_id, city_id,complainer_id, complaint_type, complaint, accusedby, complaint_detail, complaint_date, victim_address, accused_address, victim_phoneno, accused_phoneno, evidence, photo_evidence, video_evidence, anynote,complaint_status, status,victims_name)values('$_POST[station_id]', '$_POST[state_id]', '$_POST[city_id]','$_SESSION[complainer_id]', '$_POST[complaint_type]', '$_POST[complaint]', '$_POST[accusedby]', '$_POST[complaint_detail]', '$dttim', '$_POST[victim_address]', '$_POST[accused_address]', '$_POST[victim_phoneno]', '$_POST[accused_phoneno]', '$_POST[evidence]', '$photo_evidence', '$video_evidence', '$_POST[anynote]',  '$_POST[complaint_status]', 'Pending','$_POST[victims_name]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		$insid = mysqli_insert_id($con);
		echo "<script>alert('Complaint Registration done successfully');</script>";
		echo "<script>window.location='complaintacknowledgementreport.php?insid=$insid';</script>";
	}
}
?>

<?php
if(isset($_SESSION['complainer_id']))
{
	$sqlcomplainerdetail = "SELECT * FROM complainer where complainer_id='$_SESSION[complainer_id]'";
	$qsqlcomplainerdetail = mysqli_query($con,$sqlcomplainerdetail);
	$rscomplainerdetail = mysqli_fetch_array($qsqlcomplainerdetail);
}
?> 

<section class="breadcrumb-section parallax" style="background-image:url(assets/images/bg/i2.avif);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title">
                    <h1>Submit Your Report Here</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Breadcrumb Section -->
<br>
<form method="post" action="" enctype="multipart/form-data">    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Report a crime</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row" style="padding-top: 13px;">
                        <div class="col-md-12"><h4>Authorities</h4></div>
                            <div class="col-md-2">District</div>
                            <div class="col-md-10">
                                <select name="state_id" id="state_id" class="form-control" onchange="loadcity(this.value)">
                                    <option value="">Select District</option>
                                    <?php
                                    $sqlstate= "SELECT * FROM state WHERE status='Active'";
                                    $qsqlstate= mysqli_query($con,$sqlstate);
                                    while($rsstate = mysqli_fetch_array($qsqlstate))
                                    {
                                        if($rsstate['state_id'] == $rsedit['state_id'])
                                        {
                                            echo "<option value='$rsstate[state_id]' selected>$rsstate[state]</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='$rsstate[state_id]'>$rsstate[state]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">City</div>
                            <div class="col-md-10" id="divcity"><?php include("selectcity.php"); ?></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Office</div>
                            <div class="col-md-10" id="divstation"><?php include("selectoffice.php"); ?></div>
                        </div>
                        <br>
                        <div class="row" style="padding-top: 10px;">
                       <div class="col-md-12"><h4>Reporter Info</h4></div>
                            <div class="col-md-2">Name</div>
                            <div class="col-md-10">
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $rscomplainerdetail['name']; ?>" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row" >
                            <div class="col-md-2">Email</div>
                            <div class="col-md-10">
                                <input type="text" name="email_id" id="email_id" class="form-control" value="<?php echo $rscomplainerdetail['email_id']; ?>" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Phone Number</div>
                            <div class="col-md-10">
                                <input type="text" name="phoneno" id="phoneno" class="form-control" value="<?php echo $rscomplainerdetail['phoneno']; ?>" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="padding-top: 7px;">
                        <div class="col-md-12"><h4>Complaint Info</h4></div>
                            <div class="col-md-2" style="padding-top: 10px;">Complaint Title</div>
                            <div class="col-md-10">
                                <input type="text" name="complaint" id="complaint" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Complaint</div>
                            <div class="col-md-10">
                                <textarea name="complaint_detail" id="complaint_detail" class="form-control"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Suspect</div>
                            <div class="col-md-10">
                                <input type="text" name="accusedby" id="accusedby" class="form-control" placeholder="Enter name">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Suspect's Address</div>
                            <div class="col-md-10">
                                <textarea name="accused_address" id="accused_address" class="form-control"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Suspect's Phone No.</div>
                            <div class="col-md-10">
                                <input type="text" name="accused_phoneno" id="accused_phoneno" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row" style="padding-top: 10px;">
                        <div class="col-md-12"><h4>Victim's Info</h4></div>
                            <div class="col-md-2" style="padding-top: 10px;">Victim's name</div>
                            <div class="col-md-10">
                                <input type="text" name="victims_name" id="victims_name" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2" style="padding-top: 10px;">Victim Address</div>
                            <div class="col-md-10">
                                <textarea name="victim_address" id="victim_address" class="form-control"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Victim Phone No.</div>
                            <div class="col-md-10">
                                <input type="text" name="victim_phoneno" id="victim_phoneno" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row" style="padding-top: 10px;">
                        <div class="col-md-12"><h4>Provide Evidence</h4></div>
                            <div class="col-md-2">Evidence Description</div>
                            <div class="col-md-10">
                                <textarea name="evidence" id="evidence" class="form-control"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Photo Evidences</div>
                            <div class="col-md-10">
                                <input type="file" accept="image/*" name="photo_evidence" id="photo_evidence" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">Video Evidences</div>
                            <div class="col-md-10">
                                <input type="file" accept="video/mp4,video/x-m4v,video/*" name="video_evidence" id="video_evidence" class="form-control">
                            </div>
                        </div>
                        <br>
                        <?php
                        if(isset($_SESSION['cop_id']))
                        {
                            ?>
                            <div class="row">
                                <div class="col-md-2">Additional Notes</div>
                                <div class="col-md-10">
                                    <textarea name="anynote" id="anynote" class="form-control"></textarea>
                                </div>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
                    </div>
                    <hr>
                    <br>
                    <center>
                        <input type="submit" name="submit" class="form-control btn btn-primary" value="Register Complaint" style='height: 60px;width: 250px;'>
                    </center>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include("footer.php");
?>
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

<script>
function loadcity(state_id)
{
	if (state_id == "") 
	{
        document.getElementById("divcity").innerHTML = "<select name='city_id' id='city_id' class='form-control'><option value=''>Select City</option>";
        return;
    } 
	else 
	{
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divcity").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxcity.php?state_id="+state_id,true);
        xmlhttp.send();
    }
}
</script>
<script>
function loadpolicestation(city_id)
{
	if (city_id == "") 
	{
        document.getElementById("divstation").innerHTML = "<select name='station_id' id='station_id' class='form-control'><option value=''>Select Station</option>";
        return;
    } 
	else 
	{
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divstation").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxstation.php?city_id="+city_id,true);
        xmlhttp.send();
    }
}
</script>