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

  <title>Add Event</title>

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
            <h1 class="h3 mb-0 text-gray-800"><?php echo ucwords($_SESSION['fllname']); ?>'s Profile | Add Event</h1>
          </div>

          <div class="row">

            <div class="col-lg-12">



              <!-- Default Card Example -->
              <div class="card mb-4">
                <div class="card-header">
                  Add Event
                </div>
                <div class="card-body">
                  <form method="post" name="addevent" onsubmit="return checkpass();">
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">



                      <tr>
                        <th>Event Name</th>
                        <td>
                          <input type="text" class="form-control form-control-user" id="currentpwd" name="currentpwd" required="true">

                        </td>
                        <th>Venue</th>
                        <td>
                          <input type="text" class="form-control form-control-user" id="currentpwd" name="currentpwd" required="true">

                        </td>
                      </tr>
                      <tr>
                        <th>Time</th>
                        <td><input type="time" class="form-control form-control-user" id="newpwd" name="newpwd" required="true">
                        </td>
                      </tr>
                      <tr>
                        <th>Date</th>
                        <td>

                          <input type="date" class="form-control form-control-user" id="confirmpwd" name="confirmpwd" required="true">
                        </td>
                      </tr>

                    </table>
                    <button type="submit" name="change" class="btn btn-primary btn-user btn-block">
                      Add
                    </button>
                  </form>
                </div>
              </div>

            </div>

          </div>

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

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php include_once('includes/logout-modal.php'); ?>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>
<?php  ?>