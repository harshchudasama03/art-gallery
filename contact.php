<?php
session_start();
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($con, $_POST['name']);
   $email = mysqli_real_escape_string($con, $_POST['email']);
   $contact = mysqli_real_escape_string($con, $_POST['contact']);
   $message = mysqli_real_escape_string($con, $_POST['message']);

   // Insert query
   $query = "INSERT INTO tblcontact (Name, Email, ContactNo, Message) VALUES ('$name', '$email', '$contact', '$message')";

   // Execute query
   $result = mysqli_query($con, $query);

   if ($result) {
      // Store success message in session variable
      $_SESSION['success'] = "Message successfully sent.";
   } else {
      // Store error message in session variable
      $_SESSION['error'] = "Something went wrong. Please try again.";
   }

   // Redirect to the contact page to show the message
   // header("Location: contact.php");
   // exit();
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
   <title>Art Gallery Management System | Contact Us Page</title>

   <script>
      addEventListener("load", function() {
         setTimeout(hideURLbar, 0);
      }, false);

      function hideURLbar() {
         window.scrollTo(0, 1);
      }
   </script>
   <!--//meta tags ends here-->
   <!--booststrap-->
   <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
   <!--//booststrap end-->
   <!-- font-awesome icons -->
   <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
   <!-- //font-awesome icons -->
   <!--Shoping cart-->
   <link rel="stylesheet" href="css/shop.css" type="text/css" />
   <!-- toaster link -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

   <!--//Shoping cart-->
   <!--stylesheets-->
   <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
   <!--//stylesheets-->
   <link href="//fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
   <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
</head>

<body>
   <!--headder-->
   <?php include_once('includes/header.php'); ?>
   <!-- banner -->
   <div class="inner_page-banner one-img">
   </div>
   <!--//banner -->
   <!-- short -->
   <div class="using-border py-3">
      <div class="inner_breadcrumb  ml-4">
         <ul class="short_ls">
            <li>
               <a href="index.php">Home</a>
               <span>/ </span>
            </li>
            <a href="about.php">About</a>
            <span>/ </span>
            <a href="product.php">Art Type</a>
         </ul>
      </div>
   </div>
   <!-- //short-->
   <!--contact -->

   <!--subscribe-address-->
   <section class="subscribe">
      <div class="container-fluid">
         <div class="row">


            <div class="container mt-5">
               <h2>Contact Us</h2>
               <form method="POST" action="contact.php">
                  <div class="mb-3">
                     <label for="name" class="form-label">Name</label>
                     <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="mb-3">
                     <label for="email" class="form-label">Email address</label>
                     <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="mb-3">
                     <label for="contact" class="form-label">Contact No</label>
                     <input type="tel" class="form-control" maxlength="10" id="contact" name="contact" required>
                  </div>
                  <div class="mb-3">
                     <label for="message" class="form-label">Message</label>
                     <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>


            <div class="col-lg-12 col-md-12 mt-2 address-w3l-right text-center">
               <?php

               $ret = mysqli_query($con, "select * from tblpage where PageType='contactus' ");
               $cnt = 1;
               while ($row = mysqli_fetch_array($ret)) {

               ?>
                  <h4>
                     <?php echo $row['PageTitle']; ?>
                  </h4>
                  <div class="address-gried ">
                     <span class="far fa-map"></span>
                     <p>
                        <?php echo $row['PageDescription']; ?>
                     <p>
                  </div>
                  <div class="address-gried mt-3">
                     <span class="fas fa-phone-volume"></span>
                     <p>
                        <?php echo $row['MobileNumber']; ?>
                        <br>Time:
                        <?php echo $row['Timing']; ?>
                     </p>
                  </div>
                  <div class=" address-gried mt-3">
                     <span class="far fa-envelope"></span>
                     <p>
                        <?php echo $row['Email']; ?>

                     </p>
                  </div><?php } ?>
            </div>

         </div>
      </div>
   </section>
   <?php include_once('includes/footer.php'); ?>

   <!--js working-->
   <script src='js/jquery-2.2.3.min.js'></script>
   <!--//js working-->
   <!-- cart-js -->
   <script src="js/minicart.js"></script>
   <script>
      toys.render();

      toys.cart.on('toys_checkout', function(evt) {
         var items, len, i;

         if (this.subtotal() > 0) {
            items = this.items();

            for (i = 0, len = items.length; i < len; i++) {}
         }
      });
   </script>
   <!-- //cart-js -->
   <!-- start-smoth-scrolling -->
   <script src="js/move-top.js"></script>
   <script src="js/easing.js"></script>


   <!-- toaster script -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


   <script>
      <?php if (isset($_SESSION['success'])) { ?>
         toastr.success("<?php echo $_SESSION['success']; ?>");
         <?php unset($_SESSION['success']); ?>
      <?php } ?>

      <?php if (isset($_SESSION['error'])) { ?>
         toastr.error("<?php echo $_SESSION['error']; ?>");
         <?php unset($_SESSION['error']); ?>
      <?php } ?>

      toastr.options = {
         "closeButton": true,
         "progressBar": true,
         "positionClass": "toast-top-right",
         "showDuration": "300",
         "hideDuration": "1000",
         "timeOut": "5000",
         "extendedTimeOut": "1000",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut"
      };
   </script>
   <script>
      jQuery(document).ready(function($) {
         $(".scroll").click(function(event) {
            event.preventDefault();
            $('html,body').animate({
               scrollTop: $(this.hash).offset().top
            }, 900);
         });
      });
   </script>

   <script>
      document.getElementById('contact').addEventListener('input', function(e) {
         let value = this.value;
         // Remove any non-digit character
         this.value = value.replace(/\D/g, '').slice(0, 10);
      });
   </script>
   <!-- start-smoth-scrolling -->
   <!-- here stars scrolling icon -->
   <script>
      $(document).ready(function() {

         var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
         };


         $().UItoTop({
            easingType: 'easeOutQuart'
         });

      });
   </script>
   <!-- //here ends scrolling icon -->
   <!--bootstrap working-->
   <script src="js/bootstrap.min.js"></script>
   <!-- //bootstrap working-->
   <!-- //OnScroll-Number-Increase-JavaScript -->
</body>

</html>