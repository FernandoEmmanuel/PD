<?php
session_start();
require 'dbcon.php';

if (isset($_POST['delete_events'])) {
  $student_id = mysqli_real_escape_string($con, $_POST['delete_events']);

  $query = "DELETE FROM events WHERE id='$Event_Name' ";
  $query_run = mysqli_query($con, $query);

  if ($query_run) {
    $_SESSION['message'] = "Event Deleted Successfully";
    header("Location: addeventindex.php");
    exit(0);
  } else {
    $_SESSION['message'] = "Event Not Deleted";
    header("Location: addeventindex.php");
    exit(0);
  }
}

if (isset($_POST['update_events'])) {
  $Events_Name = mysqli_real_escape_string($con, $_POST['Events_Name']);

  $name = mysqli_real_escape_string($con, $_POST['event name']);
  $email = mysqli_real_escape_string($con, $_POST['venue']);
  $phone = mysqli_real_escape_string($con, $_POST['time']);
  $course = mysqli_real_escape_string($con, $_POST['date']);

  $query = "UPDATE events SET name='$name', email='$email', phone='$phone', course='$course' WHERE id='$Events_Name' ";
  $query_run = mysqli_query($con, $query);

  if ($query_run) {
    $_SESSION['message'] = "Event Updated Successfully";
    header("Location: addeventindex.php");
    exit(0);
  } else {
    $_SESSION['message'] = "Event Not Updated";
    header("Location: addeventindex.php");
    exit(0);
  }
}


if (isset($_POST['save_event'])) {
  $name = mysqli_real_escape_string($con, $_POST['event name']);
  $email = mysqli_real_escape_string($con, $_POST['venue']);
  $phone = mysqli_real_escape_string($con, $_POST['time']);
  $course = mysqli_real_escape_string($con, $_POST['date']);

  $query = "INSERT INTO events (name,venue,time,date) VALUES ('$name','$venue','$time','$date')";

  $query_run = mysqli_query($con, $query);
  if ($query_run) {
    $_SESSION['message'] = "event Created Successfully";
    header("Location: add-event.php");
    exit(0);
  } else {
    $_SESSION['message'] = "event Not Created";
    header("Location: add-event.php");
    exit(0);
  }
}
