<?php
session_start();

// Database connection
$con = new mysqli("localhost", "root", "", "umspsdb");

// Check if the connection was successful
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Function to sanitize input
function sanitize_input($data)
{
  return htmlspecialchars(strip_tags(trim($data)));
}

// Add or update live event functionality
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = isset($_POST['liveeventid']) ? sanitize_input($_POST['liveeventid']) : null;
  $name = isset($_POST['liveeventname']) ? sanitize_input($_POST['liveeventname']) : null;
  $venue = isset($_POST['venue']) ? sanitize_input($_POST['venue']) : null;
  $date = isset($_POST['date']) ? sanitize_input($_POST['date']) : null;
  $time = isset($_POST['time']) ? sanitize_input($_POST['time']) : null;

  if (isset($_POST['add'])) {
    $stmt = $con->prepare("INSERT INTO `live events` (id, name, venue, date, time) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id, $name, $venue, $date, $time);

    if ($stmt->execute()) {
      echo '<script>alert("Event added successfully.");</script>';
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }

  if (isset($_POST['update'])) {
    $stmt = $con->prepare("UPDATE `live events` SET name = ?, venue = ?, date = ?, time = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $venue, $date, $time, $id);

    if ($stmt->execute()) {
      echo '<script>alert("Event updated successfully.");</script>';
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }

  if (isset($_POST['delete'])) {
    $stmt = $con->prepare("DELETE FROM `live events` WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      echo '<script>alert("Live event deleted successfully.");</script>';
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }

  if (isset($_POST['read'])) {
    $stmt = $con->prepare("SELECT * FROM `live events` WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      if ($row) {
        $name = $row['name'];
        $venue = $row['venue'];
        $date = $row['date'];
        $time = $row['Time'];
      } else {
        echo '<script>alert("No event found with the given ID.");</script>';
      }
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Add Live Event</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once('includes/sidebar.php'); ?>
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include_once('includes/topbar.php'); ?>
        <!-- End of Topbar -->

        <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
              <?php echo isset($_SESSION['fllname']) ? ucwords($_SESSION['fllname']) : 'User'; ?>'s Profile | Add Live Event
            </h1>
          </div>

          <div class="row">

            <div class="col-lg-12">

              <div class="card mb-4">
                <div class="card-header">
                  Add Live Event
                </div>
                <div class="card-body">
                  <form method="post">
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">

                      <tr>
                        <th>Live Event ID</th>
                        <td>
                          <input type="number" class="form-control form-control-user" id="liveeventid" name="liveeventid" value="<?php echo isset($id) ? $id : ''; ?>">
                        </td>
                        <th>Live Event Name</th>
                        <td>
                          <input type="text" class="form-control form-control-user" id="liveeventname" name="liveeventname" value="<?php echo isset($name) ? $name : ''; ?>">
                        </td>
                      </tr>
                      <tr>
                        <th>Venue</th>
                        <td>
                          <input type="text" class="form-control form-control-user" id="venue" name="venue" value="<?php echo isset($venue) ? $venue : ''; ?>">
                        </td>
                      </tr>
                      <tr>
                        <th>Date</th>
                        <td>
                          <input type="date" class="form-control form-control-user" id="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
                        </td>
                      </tr>
                      <tr>
                        <th>Time</th>
                        <td>
                          <input type="time" class="form-control form-control-user" id="time" name="time" value="<?php echo isset($time) ? $time : ''; ?>">
                        </td>
                      </tr>

                    </table>
                    <button type="submit" name="add" class="btn btn-primary btn-user btn-block">
                      Add
                    </button>
                    <button type="submit" name="update" class="btn btn-primary btn-user btn-block">
                      Update
                    </button>
                    <button type="submit" name="delete" class="btn btn-primary btn-user btn-block">
                      Delete
                    </button>
                    <button type="submit" name="read" class="btn btn-primary btn-user btn-block">
                      Read
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