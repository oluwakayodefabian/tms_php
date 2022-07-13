<?php
require 'config/config.php';
$data = [];

try {

  $stmt = $connect->prepare("SELECT * FROM properties WHERE property_status=:property_status");
  $stmt->execute([':property_status' => 'vacant']);
  $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $data = $data2;

  $stmt2 = $connect->prepare("SELECT * FROM properties WHERE property_status=:property_status");
  $stmt2->execute([':property_status' => 'occupied']);
  $data3 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

  $occupiedProperties = $data3;
} catch (PDOException $e) {
  $errMsg = $e->getMessage();
}

// contact
if (isset($_POST['contact-btn'])) {
  $fullname = $_POST['first_name'] . ' ' . $_POST['last_name'];
  $email = $_POST['email'];
  $tenant = $_POST['tenant'];
  $title = $_POST['title'];
  $message = $_POST['message'];
  $property_id = $_POST['property_id'];
  try {
    $stmt = $connect->prepare('INSERT INTO complaints (complaint_title, property_id, tenant, fullname, email, complaint) VALUES (:complaint_title, :property_id, :tenant, :fullname, :email, :complaint)');
    $stmt->execute(array(
      ':complaint_title' => $title,
      ':property_id' => $property_id,
      ':tenant' => $tenant,
      ':fullname' => $fullname,
      ':email' => $email,
      ':complaint' => $message,
    ));
    $_SESSION['successMsg'] = 'Your Message has been submitted! We will get back to you as soon as possible';
    header('Location: ./index.php');
    exit;
  } catch (\PDOException $e) {
    echo $e->getMessage();
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tenancy Management System</title>
  <link rel="stylesheet" href="assets/index/vendors/mdi/css/materialdesignicons.min.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="assets/index/vendors/owl.carousel/css/owl.carousel.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="assets/index/vendors/owl.carousel/css/owl.theme.default.min.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="assets/index/vendors/aos/css/aos.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="assets/index/vendors/jquery-flipster/css/jquery.flipster.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="assets/index/css/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="assets/alertify/alertify.min.css">
  <link rel="stylesheet" href="assets/alertify/default.min.css">
  <link rel="shortcut icon" href="assets/index/images/favicon.png" />
  <link rel="stylesheet" href="./assets/index/vendors/mdi/css/materialdesignicons.min.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./assets/index/vendors/owl.carousel/css/owl.carousel.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./assets/index/vendors/owl.carousel/css/owl.theme.default.min.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./assets/index/vendors/aos/css/aos.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./assets/index/vendors/jquery-flipster/css/jquery.flipster.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./assets/index/css/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="./assets/alertify/alertify.min.css">
  <link rel="stylesheet" href="./assets/alertify/default.min.css">
  <link rel="shortcut icon" href="./assets/index/images/favicon.png" />
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
  <div id="mobile-menu-overlay"></div>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="./index.php">
        TMS.
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="mdi mdi-menu"> </i></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <div class="d-lg-none d-flex justify-content-between px-4 py-3 align-items-center">
          <img src="images/logo-dark.svg" class="logo-mobile-menu" alt="logo">
          <a href="javascript:;" class="close-menu"><i class="mdi mdi-close"></i></a>
        </div>
        <ul class="navbar-nav ml-auto align-items-center">
          <li class="nav-item active">
            <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#features">Properties</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>

          <?php
          if (!isset($_SESSION['username'])) {
            echo '<li class="nav-item">';
            echo '<a class="nav-link btn btn-success" href="./auth/login.php">Login</a>';
            echo '</li>';
          } else {
            echo '<li class="nav-item">';
            echo '<a class="nav-link btn btn-primary" href="./auth/dashboard.php">Dashboard</a>';
            echo '</li>';
          }
          ?>

        </ul>
      </div>
    </div>
  </nav>
  <div class="page-body-wrapper">
    <section id="home" class="home">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="main-banner">
              <div class="d-sm-flex justify-content-between">
                <div data-aos="zoom-in-up">
                  <div class="banner-title">
                    <h3 class="font-weight-medium">Tenancy Management At Its Best
                    </h3>
                  </div>
                  <p class="mt-3">Managing properties is really all about managing tenants,

                    <br>
                    and the foundation of a great tenant-landlord relationship is built on communication.
                  </p>
                  <a href="#about" class="btn btn-secondary mt-3">Learn more</a>
                </div>
                <div class="mt-5 mt-lg-0">
                  <img src="assets/index/images/landing.png" alt="marsmello" class="img-fluid" data-aos="zoom-in-up">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="our-services" id="features">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="font-weight-medium text-dark mb-5">Properties currently available for rent</h3>
          </div>
        </div>
        <div class="row" data-aos="fade-up">
          <div class="col-sm-12 text-center text-lg-left">
            <div class="services-box" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
              <table class="table">
                <?php foreach ($data as $key => $property) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td>This property is located at <?= $property['address'] . ', ' . $property['city'] . ', ' . $property['state'] . ',' . $property['country'] ?></td>
                    <td><button value="<?= $property['property_id'] ?>" class=" btn btn-link" data-toggle="modal" data-target="#detailsModal" id="showDetails">click to view property details</button></td>
                  </tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="our-process" id="about">
      <div class="container">
        <div class="row">
          <div class="col-sm-6" data-aos="fade-up">
            <h5 class="text-dark">Our work process</h5>
            <h3 class="font-weight-medium text-dark">Discover New Idea With Us!</h3>
            <h5 class="text-dark mb-3">Imagination will take us everywhere</h5>
            <!-- <p class="font-weight-medium mb-4">Lorem ipsum dolor sit amet, <br>
              pretium pretium tempor.Lorem ipsum dolor sit amet, consectetur
            </p>
=======
            </p> -->
          </div>
        </div>
    </section>

    <section class="contactus" id="contact">
      <div class="container">
        <div class="row mb-5 pb-5">
          <div class="col-sm-5" data-aos="fade-up" data-aos-offset="-500">
            <img src="./assets/img/SHRS.png" alt="contact" class="img-fluid">
          </div>
          <div class="col-sm-7" data-aos="fade-up" data-aos-offset="-500">
            <h3 class="font-weight-medium text-dark mt-5 mt-lg-0">Contact Us</h3>
            <p>Let us help you with your challenges</p>
            <h5 class="text-dark mb-5"></h5>
            <form method="post">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" class="form-control" id="first_name" placeholder="First Name*" name="first_name" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" class="form-control" id="last_name" placeholder="Last Name*" name="last_name" required>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <input type="email" class="form-control" id="mail" placeholder="Email*" name="email" required>
                  </div>
                </div>
                <div class="col-12 row">
                  <div class="col-sm-6">
                    <div class="form-check mb-1">
                      <p>Are you a tenant?</p>
                      <input class="form-check-input" type="radio" name="tenant" id="yes" value="Yes">
                      <label class="form-check-label" for="yes">
                        Yes
                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="tenant" id="no" value="No">
                      <label class="form-check-label" for="no">
                        No
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-6 properties" id="properties">
                    <label for="property_id">Select the property you rented</label>
                    <select class="form-control" name="property_id" id="property_id">
                      <option value="">Choose the property you want to complain on</option>
                      <?php foreach ($occupiedProperties as $property) : ?>
                        <option value="<?= $property['property_id'] ?>">This property is located at <?= $property['address'] . ', ' . $property['city'] . ', ' . $property['state'] . ',' . $property['country'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12 mt-3">
                  <div class="form-group">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title of Message*" required>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <textarea name="message" id="message" class="form-control" placeholder="Message*" rows="5" required></textarea>
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-secondary" name="contact-btn">SEND</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Property Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card text-center" style="width: 100%;">
            <img src="" class="card-img-top" alt="image of property" id="property_image" style="height: 300px">
            <div class="card-body">
              <h6 class="text-dark mb-3 mt-4 font-weight-medium" id="info">
              </h6>
              <p id="description">
                <?= $property['description'] ?>
              </p>
              <p class="h5 mt-2" id="amount"></p>
              <a href="" class="btn btn-primary" id="link">click to apply for rent</a>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer">
    <footer class="footer">
      <div class="footer-bottom">
        <div class="container">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <p class="mb-0 text-small pt-1">© 2022 <a href="#" class="text-white" target="_blank">TMS</a>. All rights reserved.</p>
              <img src="./assets/index/images/landing.png" alt="logo" class="mr-3">
              <p class="mb-0 text-small pt-1">© 2022 <a href="#" class="text-white" target="_blank">TMS</a>. All rights reserved.</p>
            </div>
            <div>
              <div class="d-flex">
                <a href="#" class="text-small text-white mx-2 footer-link">Privacy Policy </a>
                <a href="#" class="text-small text-white mx-2 footer-link">Customer Support </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="assets/index/vendors/base/vendor.bundle.base.js?v=<?php echo time(); ?>"></script>
    <script src="assets/index/vendors/owl.carousel/js/owl.carousel.js?v=<?php echo time(); ?>"></script>
    <script src="assets/index/vendors/aos/js/aos.js?v=<?php echo time(); ?>"></script>
    <script src="assets/index/vendors/jquery-flipster/js/jquery.flipster.min.js?v=<?php echo time(); ?>"></script>
    <script src="assets/index/js/template.js?v=<?php echo time(); ?>"></script>
    <script src="assets/alertify/alertify.min.js"></script>
    <?php if (isset($_SESSION['successMsg'])) : ?>
      <script>
        alertify.alert('Success', "<?= $_SESSION['successMsg'] ?>", function() {
          alertify.success('Message Sent');
        });
      </script>
    <?php endif; ?>
    <?php unset($_SESSION['successMsg']) ?>
    <?php if (isset($_SESSION['errorMsg'])) : ?>
      <script>
        alertify.alert('Error', "<?= $_SESSION['errorMsg'] ?>", function() {
          alertify.error('Action not authorized');
        });
      </script>
    <?php endif; ?>
    <?php unset($_SESSION['errorMsg']) ?>
    <script>
      $(document).ready(function() {
        $(document).on('click', '#showDetails', function() {
          const id = $(this).attr('value');
          console.log(id)
          $.ajax({
            url: "./app/helper/fetchPropertyDetails.php?property_id=" + id,
            method: 'GET',
            type: 'json',
            success: function(data) {
              const convertToObject = JSON.parse(data);
              console.log(convertToObject)
              const image = document.querySelector('#property_image');
              const link = document.querySelector('#link');
              image.src = `./app/${convertToObject.image}`;
              $('#info').text(`This property is located at ${convertToObject.address}, ${convertToObject.city}, ${convertToObject.state}, ${convertToObject.country}.`)
              $("#description").text(`Description: ${convertToObject.description}`);
              $("#amount").text(`Amount: NGN${convertToObject.rent_amount}`);
              link.href = `./auth/applyForRent.php?property_id=${convertToObject.property_id}`
            }
          })
        })

        $(document).on('click', '#yes', function() {
          $('#properties').css('display', 'block')
        })
        $(document).on('click', '#no', function() {
          $('#properties').css('display', 'none')
        })
      })
    </script>
</body>

</html>