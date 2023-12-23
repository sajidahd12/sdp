<?php
include("header.php");
if(!isset($_SESSION['cop_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM state WHERE state_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('state record deleted successfully...');</script>";
		echo "<script>window.location='viewstate.php';</script>";
	}
}
?>
<!-- Start Breadcrumb Section -->
        <section class="breadcrumb-section parallax" style="background-image:url(assets/images/bg/pexels-markus-spiske-113338.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1>Districts</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Section -->
<!-- Start Text & image Section -->
<section class="pad50" style="background-color: rgba(250, 250, 250, 1);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">View District</h3>
                    </div>
                    <div class="panel-body">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><h5>District</h5></th>
                                    <th><h5>Description</h5></th>
                                    <th><h5>Status</h5></th>
                                    <th><h5>Action</h5></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM state";
                                $qsql = mysqli_query($con, $sql);
                                while ($rs = mysqli_fetch_array($qsql)) {
                                    echo "<tr>
                                        <td>$rs[state]</td>
                                        <td>$rs[description]</td>
                                        <td>$rs[status]</td>
                                        <td>
                                            <a href='state.php?editid=$rs[0]' class='btn btn-warning'>Edit</a>
                                            <a href='viewstate.php?delid=$rs[0]' onclick='return confirmdel()' class='btn btn-danger'>Delete</a>
                                        </td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Text & image Section -->

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
#datatable {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

#datatable th,
#datatable td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

#datatable th {
    background-color: #0C0;
    color: #fff;
}

#datatable td img {
    width: 70px;
    height: 75px;
    object-fit: cover;
}

.btn {
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 2px 2px;
    cursor: pointer;
    border-radius: 4px;
}

.btn-warning {
    background-color: #ffc107;
    color: #fff;
    border: 1px solid #ffc107;
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
    border: 1px solid #dc3545;
}
</style>

<?php
include("footer.php");
?>
<script>
function confirmdel()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>