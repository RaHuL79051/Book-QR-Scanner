<?php
session_start();

include('../connection.php');

// Get UID and Student Name from session
$student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : "";
$student_name = isset($_SESSION['studentname']) ? $_SESSION['studentname'] : "";

// Check if a request already exists in the allow_permissions table for this student
$sql_check = "SELECT Permission FROM allow_permissions WHERE UID = '$student_id'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    $row = $result_check->fetch_assoc();
    $permission = $row['Permission'];

    if ($permission == 1) {
        // If permission is granted, redirect to the edit profile page
        header("Location: editProfile.php");
        exit;
    } else {
        // If permission is pending (Permission = 0), show a waiting message
        $message = "Your request is pending. Please wait for admin approval.";
    }
} else {
    // If no entry exists, process form submission to request permission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $reason = $_POST['reason'];

        // Insert request into allow_permissions table
        $sql_insert = "INSERT INTO allow_permissions (UID, Student_name, Reason_to_update, Permission) 
                      VALUES ('$student_id', '$student_name', '$reason', 0)";

        if ($conn->query($sql_insert) === TRUE) {
            $message = "Request submitted successfully! Wait for admin approval.";
        } else {
            $message = "Error submitting request: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ask for Permission</title>
  <style>
    /* General Styles */
    .permission-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f7f7f7;
    }

    .permission-box {
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

    textarea {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      resize: vertical;
      height: 100px;
    }

    textarea:focus {
      outline: none;
      border-color: #3498db;
    }

    .submit-button {
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

    .submit-button:hover {
      background-color: #2980b9;
    }

    .message {
      background-color: #2ecc71;
      color: white;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 1rem;
    }

    .back-link {
      display: inline-block;
      margin-top: 1rem;
      text-decoration: none;
      color: #3498db;
      font-size: 14px;
    }

    .back-link:hover {
      color: #2980b9;
    }
  </style>
</head>
<body>
  <div class="permission-container">
    <div class="permission-box">
      <h1>Request Permission to Edit Profile</h1>
      <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
      <?php if (!isset($message) || $message === "Error submitting request:") { ?>
        <form method="POST" action="">
          <div class="form-group">
            <label for="reason">Reason for Update</label>
            <textarea id="reason" name="reason" required></textarea>
          </div>
          <button type="submit" class="submit-button">Submit Request</button>
        </form>
      <?php } ?>
      <a href="index.php" class="back-link">Go Back</a>
    </div>
  </div>
</body>
</html>
