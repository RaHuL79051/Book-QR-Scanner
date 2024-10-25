<?php
session_start();

include('../connection.php');

// Get Student_ID from session
$student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : "";

// If form is submitted, update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $_POST['studentName'];
    $phone = $_POST['phone'];
    $rollNo = $_POST['rollNo'];
    $branch = $_POST['branch'];
    $semester = $_POST['semester'];

    // Update query to save changes
    $sql_update = "UPDATE user_login 
                   SET StudentName='$studentName', Phone='$phone', RollNo='$rollNo', Branch='$branch', Semester='$semester' 
                   WHERE Student_ID='$student_id'";

    if ($conn->query($sql_update) === TRUE) {
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile: " . $conn->error;
    }
}

// Fetch current student data
$sql = "SELECT StudentName, Phone, RollNo, Branch, Semester FROM user_login WHERE Student_ID='$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch data for the form
    $row = $result->fetch_assoc();
    $studentName = $row['StudentName'];
    $phone = $row['Phone'];
    $rollNo = $row['RollNo'];
    $branch = $row['Branch'];
    $semester = $row['Semester'];
} else {
    echo "Error: No student found with Student_ID: $student_id";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <style>
    /* General reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #f5f6fa;
      color: #333;
    }

    .edit-profile-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f5f5f5;
    }

    .edit-profile-box {
      background-color: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
      text-align: center;
    }

    h1 {
      font-size: 24px;
      color: #3498db;
      margin-bottom: 1.5rem;
    }

    .message {
      background-color: #2ecc71;
      color: white;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 1rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      font-size: 14px;
      color: #7f8c8d;
      margin-bottom: 0.5rem;
      text-align: left;
    }

    input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    input:focus {
      outline: none;
      border-color: #3498db;
    }

    .save-button {
      display: inline-block;
      padding: 0.75rem 1.5rem;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .save-button:hover {
      background-color: #2980b9;
    }

    .back-link {
      display: inline-block;
      margin-top: 1rem;
      text-decoration: none;
      color: #3498db;
      font-size: 14px;
      transition: color 0.3s ease;
    }

    .back-link:hover {
      color: #2980b9;
    }
  </style>
</head>
<body>
  <div class="edit-profile-container">
    <div class="edit-profile-box">
      <h1>Edit Profile</h1>
      <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
      <form method="POST" action="">
        <div class="form-group">
          <label for="studentName">Name</label>
          <input type="text" id="studentName" name="studentName" value="<?php echo $studentName; ?>" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required>
        </div>
        <div class="form-group">
          <label for="rollNo">Roll No</label>
          <input type="text" id="rollNo" name="rollNo" value="<?php echo $rollNo; ?>" required>
        </div>
        <div class="form-group">
          <label for="branch">Branch</label>
          <input type="text" id="branch" name="branch" value="<?php echo $branch; ?>" required>
        </div>
        <div class="form-group">
          <label for="semester">Semester</label>
          <input type="number" id="semester" name="semester" value="<?php echo $semester; ?>" required>
        </div>
        <button type="submit" class="save-button">Save Changes</button>
      </form>
      <a href="index.php" class="back-link">Go Back</a>
    </div>
  </div>
</body>
</html>
