<?php
// Start session for user authentication
include('../connection.php');
session_start();

$studentname = isset($_SESSION['studentname']) ? $_SESSION['studentname'] : "";
$student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : "";

// Ensure studentname and student_id are not empty before displaying them


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
<header class="TopHeader">
  <section class="profile">
    <img src="profile.jpg" alt="" />
    <?php
    if (!empty($studentname) && !empty($student_id)) {
      echo "<h1>Welcome, $studentname</h1>";
      echo "<h3>UID: $student_id</h3>";
    } else {
      echo "<h1>Error: Student information not found!</h1>";
    }
    ?>
    <button class="edit-profile-button" onclick="window.location.href = './showProfile.php'" style="margin-right: 10px;"> Show Profile</button>
    <button class="edit-profile-button" onclick="window.location.href = './askPermission.php'">Edit Profile</button>
  </section>
  <section class="Scanner">
    <div id="container">
      <video id="video" playsinline></video>
      <img id="scannedImage" />
      <div id="qrData"></div>
      <div id="buttons">
        <button class="button" id="webcamButton">
          Open Camera to scan
        </button>
      </div>
    </div>
    <form id="su bmitForm" class="Form" action="submit_data.php" method="POST">
      <input
        type="text"
        id="name"
        name="name"
        placeholder="Name"
        required
      /><br />
      <input
        type="text"
        id="author"
        name="author"
        placeholder="Author"
        required
      /><br />
      <input
        type="text"
        id="isbn"
        name="isbn"
        placeholder="ISBN"
        required
      /><br />
      <input
        type="text"
        id="title"
        name="title"
        placeholder="Title"
        required
      /><br />
      <input
        type="text"
        id="uid"
        name="uid"
        placeholder="UID"
        value="<?php echo $student_id;?>"
      /><br />
      <input type="date" name="date" id="date" requ />
      <br />
      <button type="submit">Submit</button>
      <button type="reset" onclick="window.location.href='./index.php'">Reset</button>
    </form>
  </section>
</header>
<div class="BelowPart" id="belowPart">
  <?php

  // Handle deletion if the form is submitted
  // Handle deletion (returning a book) if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['delete_id'])) {
      $delete_id = $_POST['delete_id'];

      // Fetch the book details before deletion
      $sql = "SELECT * FROM requested_books WHERE id = $delete_id";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Fetch the row data
          $row = $result->fetch_assoc();
          $book_name = $row['Title'];
          $issued_date = $row['Date'];
          $isbn = $row['ISBN'];
          $student_id = $row['Student_ID'];
          $student_name = $studentname; // Assuming you want to use the session's student name
          $returned_date = date('Y-m-d'); // Get the current date for the returned date

          // Insert the data into the History table
          $sql_insert = "INSERT INTO History (UID, Student_name, Book_name, Issued_date, Return_date, ISBN) 
                         VALUES ('$student_id', '$student_name', '$book_name', '$issued_date', '$returned_date', '$isbn')";

          if ($conn->query($sql_insert) === TRUE) {
              // Now delete from the requested_books table
              $sql_delete = "DELETE FROM requested_books WHERE id = $delete_id";

              if ($conn->query($sql_delete) === TRUE) {
              } else {
                  echo "Error deleting record: " . $conn->error;
              }
          } else {
              echo "Error inserting into History: " . $conn->error;
          }
      } else {
      }
  }
}


  // Query to fetch data from your table
  $sql = "SELECT id, name, author, ISBN, Title, Date, Issued FROM requested_books where Student_ID = $student_id";
  $result = $conn->query($sql);
  echo "<h1>History</h1>";
  // Display fetched data in a table
  if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Author</th><th>ISBN</th><th>Title</th><th>Date</th><th>Issued</th><th>Action</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["author"]. "</td><td>" . $row["ISBN"]. "</td><td>" . $row["Title"]. "</td><td>" . $row["Date"]. "</td><td>" . ($row["Issued"] == 0 ? "Pending" : "Issued") . "</td>";
      // Only show the "Return" button if the status is "Issued"
      if ($row["Issued"] == 1) {
        echo "<td><form method='post'><input type='hidden' name='delete_id' value='" . $row["id"] . "'><button type='submit'>Return</button></form></td>";
      } else {
        echo "<td>Pending</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "<h1 style='text-align:center'>Scan QR Code to issue Book</h1>";
  }
  
  $conn->close();
  ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="script.js"></script>
</body>
</html>
