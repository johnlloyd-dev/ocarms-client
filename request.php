<?php
   session_start(); 
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>OCARMS - Online Calamity Assistance Requests and Monitoring System</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="Construction Company Website Template" name="keywords">
      <meta content="Construction Company Website Template" name="description">
      <!-- Favicon -->
      <link href="img/favicon.ico" rel="icon">
      <!-- Google Font -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
      <!-- CSS Libraries -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
      <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
      <link href="lib/animate/animate.min.css" rel="stylesheet">
      <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
      <link href="lib/slick/slick.css" rel="stylesheet">
      <link href="lib/slick/slick-theme.css" rel="stylesheet">
      <!-- Template Stylesheet -->
      <link href="css/style.css?v=<?php echo date('s'); ?>" rel="stylesheet">
      <link href="css/forms.css?v=<?php echo date('s'); ?>" rel="stylesheet">
   </head>
   <body>
      <div class="wrapper">
      <!-- Top Bar Start -->
      <?php include('includes/topbar.php') ?>
      <!-- Top Bar End -->
      <!-- Nav Bar Start -->
      <div class="nav-bar">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
               <a href="#" class="navbar-brand">MENU</a>
               <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                  <div class="navbar-nav mr-auto">
                     <a href="index.php" class="nav-item nav-link">Home</a>
                     <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Campaigns</a>
                        <div class="dropdown-menu rounded">
                           <a href="campaigns_monetory.php" class="dropdown-item">
                              <i class="fas fa-dollar-sign fa-sm fa-fw mr-2 text-gray-200"></i>
                                 Monetory
                           </a>
                           <a href="campaigns_goods.php" class="dropdown-item">
                              <i class="fas fa-box fa-sm fa-fw mr-2 text-gray-200"></i>
                                 Goods
                           </a>
                        </div>
                     </div>
                     <a href="volunteer.php" class="nav-item nav-link">Volunteer</a>
                     <a href="request.php" class="nav-item nav-link active">Request</a>
                     <a href="blog.php" class="nav-item nav-link">Bulletin/Events</a>
                     <a href="contact.php" class="nav-item nav-link">Contact</a>
                     <a href="about.php" class="nav-item nav-link">About</a>
                  </div>
                  <div class="navbar-nav ml-auto">
                        <?php
                           require 'includes/connect.php';
                           if(isset($_SESSION['login_id'])){
                           $id = $_SESSION['login_id'];

                           $get_user = mysqli_query($conn, "SELECT * FROM `client_information` WHERE `google_id`='$id'");
                           $user = mysqli_fetch_assoc($get_user);

                           $client_id = $user['client_id'];

                           $amount_query=mysqli_query($conn,"SELECT SUM(donation_amount) as _sum FROM monetary_donation_info WHERE client_id = $client_id AND donation_type = 'Fundraise Donation' AND donation_status = 'Carted'");
                           $row_amount=mysqli_fetch_array($amount_query);
                           $total_2 = $row_amount["_sum"]
                        ?>
                                                <a class="mr-2 d-none d-lg-inline small text-user text-orange" href="donate_cart.php">
                           <i class="fas fa-cart-plus fa-lg fa-fw mr-2 text-gray-400"></i><?php echo $total_2;?>
                        </a>
                        <div class="nav-item dropdown animated--grow-in no-arrow">
                           <a class="nav-link-2 dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <?php
                                 $img = $user['image_name'];
                                 $disp_img = $user['client_image'];
                                 if($img == "null.jpg" && $disp_img == null){
                                    $image_src = "img/Logo.png";
                                 }else if($img != "null.jpg" && $img != "" && $disp_img != null){
                                    $image_src = "includes/client_credentials/image_view.php?google_id=$id";
                                 }else if($img == "" && $disp_img != null){
                                    $image_src = $user['client_image'];
                                 }
                              ?>
                           <img class="img-profile rounded-circle" src="<?php echo $image_src; ?>" alt="<?php echo $user['client_name']; ?>">
                           </a>
                           <div class="dropdown-menu drop rounded dropdown-menu-right" aria-labelledby="userDropdown">
                           <img class="img-profile rounded-circle" src="<?php echo $image_src; ?>" alt="<?php echo $user['client_name']; ?>">
                           <p class="text-center"><?php echo $user['client_name']; ?></p>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="account.php">
                              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                              My Account
                           </a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="includes/logout.php">
                              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                              Signout
                           </a>
                        </div>
                        </div>
                        <?php } else { ?>
                           <a class="btn" href="user_credentials_register.php?l=3">Register</a>
                        <?php } ?>
                     </div>
               </div>
            </nav>
         </div>
      </div>
      <!-- Nav Bar End -->
      <!-- Page Header Start -->
      <div class="page-header">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <h2>Request Assistance</h2>
               </div>
               <div class="col-12">
                  <a href="index.php">Home</a>
                  <a href="">Request Assistance</a>
               </div>
            </div>
         </div>
      </div>
      <!-- Page Header End -->
      <!-- Service Start -->
      <div class="service">
         <div class="container">
            <div class="section-header text-center">
               <p>Request Assistance</p>
               <h2>Request Today</h2>
            </div>
         <form action="includes/requests/connections.php" class="wow fadeInUp" method="POST" enctype="multipart/form-data">
            <!--  General -->
            <div class="row justify-content-center">
               <div class="col-lg-6 col-md-8 col-sm-10 col-10">
                  <div class="form-group1">
                     <h2 class="heading1">Personal Information</h2>
                     <div class="controls1">
                        <input type="text" id="name" class="floatLabel" name="full_name" required>
                        <label for="name">Full Name</label>
                     </div>
                     <div class="controls1">
                        <input type="tel" id="phone" class="floatLabel" name="contact_number" required>
                        <label for="phone">Contact Number</label>
                     </div>
                     <div class="grid1">
                        <div class="controls1">
                           <i class="fa fa-sort"></i>
                           <select class="floatLabel" name="barangay" required>
                              <option selected disabled>Select Barangay</option>
                              <option value="Cadulawan">Cadulawan</option>
                              <option value="Calajo-an">Calajo-an</option>
                              <option value="Camp 7">Camp 7</option>
                              <option value="Camp 8">Camp 8</option>
                              <option value="Cuanos">Cuanos</option>
                              <option value="Guindaruhan">Guindaruhan</option>
                              <option value="Linao-Lipata">Linao-Lipata</option>
                              <option value="Manduang">Manduang</option>
                              <option value="Pakigne">Pakigne</option>
                              <option value="Poblacion Ward I">Poblacion Ward I</option>
                              <option value="Poblacion Ward II">Poblacion Ward II</option>
                              <option value="Poblacion Ward III">Poblacion Ward III</option>
                              <option value="Poblacion Ward IV">Poblacion Ward IV</option>
                              <option value="Tubod">Tubod</option>
                              <option value="Tulay">Tulay</option>
                              <option value="Tunghaan">Tunghaan</option>
                              <option value="Tungkil">Tungkil</option>
                              <option value="Tungkop">Tungkop</option>
                              <option value="Vito">Vito</option>
                           </select>
                           <label for="fruit"><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Select Barangay</label>
                        </div>
                     </div>
                     <h6 class="heading-1 mb-3"></h6>
                     <div class="form-group1">
                        <h2 class="heading1">Assistance Request Details</h2>
                        <div class="controls1">
                           <input type="text" id="request_details" class="floatLabel" name="request_details" required>
                           <label for="request_details">What is your request/s?</label>
                        </div>
                        <div class="grid1">
                           <p class="info-text">Please specify your request/s.</p>
                           <br>
                           <div class="controls1">
                              <textarea name="description" class="floatLabel" id="description" required></textarea>
                              <label for="description">Request Description</label>
                           </div>
                           <button type="submit" value="Submit" class="col-frm-1-4">Submit</button>
                        </div>
                     </div>
                     <!-- /.form-group -->
                  </div>
               </div>
            </div>
         </form>
         </div>
      </div>
         <!-- Service End -->
         <!-- Footer Start -->
         <?php include("includes/footer.php") ?>
         <!-- Footer End -->
         <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>


         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;
                        </span>
                     </button>
                  </div>

                  <div class="modal-body">
                     <div class="container-fluid">
                        <div class="border mt-3 rounded">
                           <div class="p-3 mb-2 bg-warning rounded-top text-dark-blue text-center">
                              <h3>Hello Minglanillahanons!</h3>
                              <p class="text-dark-blue font-weight-bold">This page is the official website of DSWD Minglanilla for assistance requests.</p>
                           </div>
                           <div class="p-2 mt-3">
                              <div class="row justify-content-center">
                                 <div class="col-11">
                                    <p class="text-dark-blue">These are the following forms of assistance that can be requested from the office
                                       of DSWD
                                       Minglanilla.</p>
                                    <dl class="row text-dark-blue">
                                       <dt class="col-sm-4">Goods Assistance</dt>
                                       <dd class="col-sm-8 mb-4">These could be food, clothes, house materials (esp. damaged
                                          by a disaster),
                                          water, and other necessities.</dd>
                                       <dt class="col-sm-4">Financial Assistance</dt>
                                       <dd class="col-sm-8">This specifically refers to cash assistance which will be catered only for emergency needs.</dd>
                                    </dl>
                                    <p class="text-danger">Note: Your request will undergo proper and strict validation and confirmation
                                       before approval. 
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">
                        <i class="fas fa-hand-holding-heart">
                        </i> I understand!
                     </button>
                  </div>
               </div>
            </div>
         </div>



      </div>
      <!-- JavaScript Libraries -->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
      <script src="lib/easing/easing.min.js"></script>
      <script src="lib/wow/wow.min.js"></script>
      <script src="lib/owlcarousel/owl.carousel.min.js"></script>
      <script src="lib/isotope/isotope.pkgd.min.js"></script>
      <script src="lib/lightbox/js/lightbox.min.js"></script>
      <script src="lib/waypoints/waypoints.min.js"></script>
      <script src="lib/counterup/counterup.min.js"></script>
      <script src="lib/slick/slick.min.js"></script>
      <!-- Template Javascript -->
      <script src="js/main.js"></script>
      <script src="js/forms.js"></script>
      <script>
         $(document).ready(function(){
            $("#myModal").modal('show');
         });

         function readURL1(input) {
            if (input.files && input.files[0]){
            var reader = new FileReader();
               reader.onload = function (e) {
                  $('#imagePreview1').attr('src', e.target.result);
               }
                  reader.readAsDataURL(input.files[0]);
            }
         }

         function readURL2(input) {
            if (input.files && input.files[0]){
            var reader = new FileReader();
               reader.onload = function (e) {
                  $('#imagePreview2').attr('src', e.target.result);
               }
                  reader.readAsDataURL(input.files[0]);
            }
         }
      </script>
   </body>
</html>