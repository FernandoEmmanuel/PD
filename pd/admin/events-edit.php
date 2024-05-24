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
            <h1 class="h3 mb-0 text-gray-800"><?php echo ucwords($_SESSION['fllname']); ?>'s Profile | Event Details</h1>
          </div>



          <div class="container mt-4">
            <?php include('message.php'); ?>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Event Details
                      <a href="add-event.php" class="btn btn-primary float-end">watch Event</a>
                    </h4>
                  </div>
                  <div class="card-body">

                    <?php
                    if (isset($_GET['Event Name'])) {
                      $student_id = mysqli_real_escape_string($con, $_GET['Event Name']);
                      $query = "SELECT * FROM events WHERE id='$events_name' ";
                      $query_run = mysqli_query($con, $query);

                      if (mysqli_num_rows($query_run) > 0) {
                        $events = mysqli_fetch_array($query_run);
                    ?>
                        <form action="code.php" method="POST">
                          <input type="hidden" name="events_name" value="<?= $events['Event Name']; ?>">

                          <div class="mb-3">
                            <label>Event Name</label>
                            <input type="text" name="name" value="<?= $events['name']; ?>" class="form-control">
                          </div>
                          <div class="mb-3">
                            <label>Venue</label>
                            <input type="text" name="name" value="<?= $events['Venue']; ?>" class="form-control">
                          </div>
                          <div class="mb-3">
                            <label>Time</label>
                            <input type="time" name="time" value="<?= $events['phone']; ?>" class="form-control">
                          </div>
                          <div class="mb-3">
                            <label>Date</label>
                            <input type="date" name="date" value="<?= $events['course']; ?>" class="form-control">
                          </div>
                          <div class="mb-3">
                            <button type="submit" name="update_events" class="btn btn-primary">
                              Update Event
                            </button>
                          </div>

                        </form>
                    <?php
                      } else {
                        echo "<h4>No Such Event Found</h4>";
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