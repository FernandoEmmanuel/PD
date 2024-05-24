<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['uid']) == 0) {
  header('location:logout.php');
} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Olympic Streaming Platform</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <?php include_once('includes/sidebar.php'); ?>
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <?php include_once('includes/topbar.php'); ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <h2 class="section-heading text-uppercase">Users Complaints</h2>
            <hr class="my-4">
            <?php
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "umspsdb");

            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            // Fetch Complaints
            $sql = "SELECT id, complaints FROM `complaints`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              echo "<ul class='list-unstyled'>";
              while ($row = $result->fetch_assoc()) {
                echo "<li class='mb-3'>";
                echo "<h4>id: " . htmlspecialchars($row["id"]) . "</h4>";
                echo "<p>about: " . htmlspecialchars($row["about"]) . "</p>";
                echo "</li>";
              }
              echo "</ul>";
            } else {
              echo "<p>No Complaints </p>";
            }

            // Close connection
            $conn->close();
            ?>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once('includes/footer.php'); ?>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <?php include_once('includes/logout-modal.php'); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
  </body>

  </html>
<?php } ?>