
        <!-- Start  Copyright Section -->
        <section class="copyright-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright-text text-center">
                            <p>ECOPULSE |  © All Rights Reserved.
<?php
$current_page = basename($_SERVER['PHP_SELF']);
$allowed_page = 'officerlog.php';

if (!isset($_SESSION['cop_id']) && !isset($_SESSION['complainer_id']) && $current_page === $allowed_page) {
?>
    <hr><br><a href="" onclick="return false" data-toggle="modal" data-target="#copLoginModal" class="btn btn-warning">Officer Login</a>
<?php
}
?>

	</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Copyright Section -->

        
        <script src="assets/js/jquery-3.1.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/rev_slider/jquery.themepunch.tools.min.js"></script>
        <script src="assets/js/rev_slider/jquery.themepunch.revolution.min.js"></script>
        
        <script src="assets/js/rev_slider/extensions/revolution.extension.actions.min.js"></script>
        <script src="assets/js/rev_slider/extensions/revolution.extension.carousel.min.js"></script>
        <script src="assets/js/rev_slider/extensions/revolution.extension.kenburn.min.js"></script>
        <script src="assets/js/rev_slider/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="assets/js/rev_slider/extensions/revolution.extension.migration.min.js"></script>
        <script src="assets/js/rev_slider/extensions/revolution.extension.navigation.min.js"></script>
        <script src="assets/js/rev_slider/extensions/revolution.extension.parallax.min.js"></script>
        <script src="assets/js/rev_slider/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="assets/js/rev_slider/extensions/revolution.extension.video.min.js"></script>
        <script src="assets/js/jquery.appear.js"></script>
        <script src="assets/js/jquery.countTo.js"></script>
        <script src="assets/js/jquery.isotope.min.js"></script>
        <script src="assets/js/lightbox.js"></script>
        <script src="assets/js/owl.carousel.js"></script>
        <script src="assets/js/jquery.easypiechart.js"></script>
        <script src="assets/js/jquery.mb.YTPlayer.js"></script>
        <script src="assets/js/countdown.js"></script>
        <script src="assets/js/jquery.fitvids.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.fixedColumns.min.js"></script>
<script>		
$(document).ready( function () {
    $('#datatable').DataTable();
} );
</script>
    </div>   


	<form method="post" action="">
  <div class="modal fade" id="myLoginModal" role="dialog" style="z-index: 10000;">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login Modal</h4>
        </div>
        <div class="modal-body" style="padding-left: 30px;padding-right: 30px;">
          <p>
            <div class="row" style="padding-bottom: 10px;">
            Email ID: <input type="text" name="compemailid" id="compemailid" class="form-control">
            </div>
            <div class="row">
            Password: <input type="password" name="comppassword" id="comppassword" class="form-control">
            </div>
		  </p>
        </div>
        <div class="modal-footer">
          <button type="submit" name="btncomplogin" id="btncomplogin" class="btn btn-success" >Login Here</button>
        </div>
      </div>
      
    </div>
  </div>
		  </form>

<form method="post" action="">
  <div class="modal fade" id="copLoginModal" role="dialog" style="z-index: 10000;">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Officer Login Portal</h4>
        </div>
        <div class="modal-body" style="padding-left: 30px;padding-right: 30px;">
          <p>
                <div class="row" style="padding-bottom: 10px;">
                    Username: <input type="text" name="coploginid" id="coploginid" class="form-control">
                </div>
                <div class="row">
                    Password: <input type="password" name="coppassword" id="coppassword" class="form-control">
                </div>
		  </p>
        </div>
        <div class="modal-footer">
          <button type="submit" name="btncoplogin" id="btncoplogin" class="btn btn-warning" >Login</button>
        </div>
      </div>
      
    </div>
  </div>
		  </form>
	
    </body>
</html>