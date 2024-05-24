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
  $id = isset($_POST['id']) ? sanitize_input($_POST['id']) : null;
  $notification = isset($_POST['notification']) ? sanitize_input($_POST['notification']) : null;

  // Check which button is clicked
  if (isset($_POST['add'])) {
    // Add notification
    if (!empty($notification)) {
      $stmt = $con->prepare("INSERT INTO `notifications` (id, notification) VALUES (?, ?)");
      $stmt->bind_param("is", $id, $notification);

      if ($stmt->execute()) {
        echo '<script>alert("Notification sent.");</script>';
      } else {
        echo "Error: " . $stmt->error;
      }
      $stmt->close();
    } else {
      // Handle the case where notification is empty
      echo '<script>alert("Notification cannot be empty.");</script>';
    }
  } elseif (isset($_POST['update'])) {
    // Update notification
    if (!empty($notification)) {
      $stmt = $con->prepare("UPDATE `notifications` SET notification = ? WHERE id = ?");
      $stmt->bind_param("si", $notification, $id);

      if ($stmt->execute()) {
        echo '<script>alert("Notification updated successfully.");</script>';
      } else {
        echo "Error: " . $stmt->error;
      }
      $stmt->close();
    } else {
      // Handle the case where notification is empty
      echo '<script>alert("Notification cannot be empty.");</script>';
    }
  } elseif (isset($_POST['delete'])) {
    // Delete notification
    $stmt = $con->prepare("DELETE FROM `notifications` WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      echo '<script>alert("Notification deleted successfully.");</script>';
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  } elseif (isset($_POST['read'])) {
    // Read notification
    $stmt = $con->prepare("SELECT notification FROM `notifications` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($notification);
    $stmt->fetch();
    $stmt->close();

    echo "<script>alert('Notification: $notification');</script>";
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

  <title>Create Notification</title>

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
              <?php echo isset($_SESSION['fllname']) ? ucwords($_SESSION['fllname']) : 'User'; ?>'s Profile | Create Notifications
            </h1>
          </div>

          <div class="row">

            <div class="col-lg-12">

              <div class="card mb-4">
                <div class="card-header">
                  Create Notification
                </div>
                <div class="card-body">
                  <form method="post">
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">

                      <tr>
                        <th>ID</th>
                        <td>
                          <input type="number" class="form-control form-control-user" id="id" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                        </td>
                        <th>Notify</th>
                        <td>
                          <input type="text" class="form-control form-control-user" id="notification" name="notification" value="<?php echo isset($notification) ? $notification : ''; ?>">
                        </td>
                      </tr>

                    </table>
                    <button type="submit" name="add" class="btn btn-primary btn-user btn-block">
                      Send
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
</body