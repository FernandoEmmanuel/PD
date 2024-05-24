<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Event View</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once('includes/sidebar.php'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->

        <!-- Topbar Navbar -->
        <?php include_once('includes/topbar.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo ucwords($_SESSION['fllname']); ?>'s Profile | Event View</h1>
          </div>



          <body>

            <div class="container mt-5">

              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Event View
                        <a href="events-edit.php" class="btn btn-danger float-end">BACK</a>
                      </h4>
                    </div>
                    <div class="card-body">

                      <?php
                      if (isset($_GET['id'])) {
                        $Event_Name = mysqli_real_escape_string($con, $_GET['id']);
                        $query = "SELECT * FROM events WHERE id='$Event_Name' ";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          $events = mysqli_fetch_array($query_run);
                      ?>

                          <div class="mb-3">
                            <label>Event Name</label>
                            <p class="form-control">
                              <?= $events['name']; ?>
                            </p>
                          </div>
                          <div class="mb-3">
                            <label>Venue</label>
                            <p class="form-control">
                              <?= $events['email']; ?>
                            </p>
                          </div>
                          <div class="mb-3">
                            <label>Time</label>
                            <p class="form-control">
                              <?= $events['phone']; ?>
                            </p>
                          </div>
                          <div class="mb-3">
                            <label>Date</label>
                            <p class="form-control">
                              <?= $events['course']; ?>
                            </p>
                          </div>

                      <?php
                        } else {
                          echo "<h4>No Such EventFound</h4>";
                        }
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <script src="../js/sb-admin-2.min.js"></script>
          </body>

</html>