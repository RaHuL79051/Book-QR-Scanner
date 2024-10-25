<?php
session_start();

include('../connection.php');

// Get Student_ID from session
$student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : "";


// Fetch student profile data
$sql = "SELECT StudentName, Phone, RollNo, Branch, Semester, PendingDues FROM user_login WHERE Student_ID = '$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the student's data
    $row = $result->fetch_assoc();
    $studentName = $row['StudentName'];
    $phone = $row['Phone'];
    $rollNo = $row['RollNo'];
    $branch = $row['Branch'];
    $semester = $row['Semester'];
    $pendingDues = $row['PendingDues'];
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
  <title>Show Profile</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f6f7;
      color: #333;
    }

    .profile-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #ecf0f1;
    }

    .profile-box {
      background-color: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
    }

    h1 {
      font-size: 26px;
      color: #2c3e50;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .profile-info {
      margin-bottom: 1.5rem;
    }

    .profile-info h2 {
      font-size: 20px;
      color: #3498db;
      margin-bottom: 1rem;
      text-align: center;
    }

    .profile-info p {
      font-size: 16px;
      margin: 0.5rem 0;
      color: #34495e;
    }

    .profile-info p span {
      font-weight: bold;
      color: #2ecc71;
    }

    .action-buttons {
      display: flex;
      justify-content: center;
      margin-top: 2rem;
    }

    .back-button, .edit-button {
      display: inline-block;
      padding: 0.75rem 1.5rem;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      margin: 0 10px;
      transition: background-color 0.3s ease;
    }

    .back-button:hover {
      background-color: #2980b9;
    }

    .edit-button:hover {
      background-color: #27ae60;
    }
  </style>
</head>
<body>

  <div class="profile-container">
    <div class="profile-box">
      <h1>Student Profile</h1>
      <div class="profile-info">
        <h2>Profile Details</h2>
        <p><span>Name:</span> <?php echo $studentName; ?></p>
        <p><span>Phone:</span> <?php echo $phone; ?></p>
        <p><span>Roll No:</span> <?php echo $rollNo; ?></p>
        <p><span>Branch:</span> <?php echo $branch; ?></p>
        <p><span>Semester:</span> <?php echo $semester; ?></p>
        <p><span>Pending Dues:</span> <?php echo $pendingDues; ?></p>
      </div>

      <div class="action-buttons">
        <button class="back-button" onclick="window.location.href = 'index.php'">Go Back</button>
        <button class="edit-button" onclick="window.location.href = 'askPermission.php'">Edit Profile</button>
      </div>
    </div>
  </div>

</body>
</html>
