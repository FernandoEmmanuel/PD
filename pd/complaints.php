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

// Add or update complaint functionality
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = isset($_POST['complaintid']) ? sanitize_input($_POST['complaintid']) : null;
  $about = isset($_POST['about']) ? sanitize_input($_POST['about']) : null;

  if (isset($_POST['add'])) {
    $stmt = $con->prepare("INSERT INTO `complaints` (id, about) VALUES (?, ?)");
    $stmt->bind_param("is", $id, $about);

    if ($stmt->execute()) {
      echo '<script>alert("comment sent successfully.");</script>';
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }

  if (isset($_POST['update'])) {
    $stmt = $con->prepare("UPDATE `complaints` SET about = ? WHERE id = ?");
    $stmt->bind_param("si", $about, $id);

    if ($stmt->execute()) {
      echo '<script>alert("comment updated successfully.");</script>';
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }

  if (isset($_POST['delete'])) {
    $stmt = $con->prepare("DELETE FROM `complaints` WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      echo '<script>alert("comment deleted successfully.");</script>';
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }

  if (isset($_POST['read'])) {
    $stmt = $con->prepare("SELECT * FROM `complaints` WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      if ($row) {
        $about = $row['about'];
      } else {
        echo '<script>alert("No comment found with the given ID.");</script>';
      }
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Olympic Streaming PLatform</title>

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
    <?php include_once('includes/sidebar.php '); ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include_once('includes/topbar.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

        </div>
        <!-- /.container-fluid -->
        <form method="post">
          <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">

            <tr>
              <th>ID</th>
              <td>
                <input type="number" class="form-control form-control-user" id="complaintid" name="complaintid" value="<?php echo isset($id) ? $id : ''; ?>">
              </td>
              <th>About</th>
              <td>
                <input type="text" class="form-control form-control-user" id="about" name="about" value="<?php echo isset($about) ? $about : ''; ?>">
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