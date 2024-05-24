<?php
session_start();
require 'dbcon.php';

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
                      <a href="add-event.php" class="btn btn-primary float-end">Add Event</a>
                    </h4>
                  </div>
                  <div class="card-body">

                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Event Name</th>
                          <th>Venue</th>
                          <th>Time</th>
                          <th>Date</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM events";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          foreach ($query_run as $events) {
                        ?>
                            <tr>
                              <td><?= $events['Event Name']; ?></td>
                              <td><?= $events['Venue']; ?></td>
                              <td><?= $events['Time']; ?></td>
                              <td><?= $events['Date']; ?></td>

                              <td>
                                <a href="events-view.php?id=<?= $events['id']; ?>" class="btn btn-info btn-sm">View</a>
                                <a href="events-edit.php?id=<?= $events['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <form action="code.php" method="POST" class="d-inline">
                                  <button type="submit" name="delete_events" value="<?= $events['event-name']; ?>" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                              </td>
                            </tr>
                        <?php
                          }
                        } else {
                          echo "<h5> No Record Found </h5>";
                        }
                        ?>

                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
<?php  ?>