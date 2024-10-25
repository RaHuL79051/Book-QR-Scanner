<?php
// Database connection
include('../connection.php');

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST['Student_ID'];
    $studentName = $_POST['StudentName'];
    $phone = $_POST['Phone'];
    $rollNo = $_POST['RollNo'];
    $password = $_POST['Password'];
    $branch = $_POST['Branch'];
    $semester = $_POST['Semester'];
    $pendingDues = $_POST['PendingDues'];

    $sql = "INSERT INTO user_login (Student_ID, StudentName, Phone, RollNo, Password, Branch, Semester, PendingDues)
            VALUES ('$studentID', '$studentName', '$phone', '$rollNo', '$password', '$branch', '$semester', '$pendingDues')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ./StudentPage.php");
    } else {
        echo "<p class='error-message'>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register New Student</title>
    <link rel="stylesheet" href="style.css" />
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f7fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }

      .form-container {
        background-color: #fff;
        width: 90%;
        max-width: 500px;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      }

      .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #4a4a4a;
        font-size: 24px;
      }

      .form-group {
        margin-bottom: 15px;
      }

      .form-group label {
        display: block;
        font-weight: bold;
        color: #4a4a4a;
        margin-bottom: 5px;
      }

      .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s;
      }

      .form-group input:focus {
        border-color: #4a90e2;
      }

      .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: #4a90e2;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
      }

      .submit-btn:hover {
        background-color: #357ab9;
      }

      .success-message, .error-message {
        text-align: center;
        font-size: 16px;
        margin-top: 10px;
        padding: 10px;
        border-radius: 5px;
      }

      .success-message {
        color: #28a745;
        background-color: #e9f7ef;
      }

      .error-message {
        color: #dc3545;
        background-color: #f8d7da;
      }
    </style>
  </head>
  <body>
    <div class="form-container">
      <h2>Register New Student</h2>
      <form action="addStudent.php" method="POST">
        <div class="form-group">
          <label for="Student_ID">Student ID:</label>
          <input type="text" id="Student_ID" name="Student_ID" required />
        </div>
        <div class="form-group">
          <label for="StudentName">Student Name:</label>
          <input type="text" id="StudentName" name="StudentName" required />
        </div>
        <div class="form-group">
          <label for="Phone">Phone:</label>
          <input type="tel" id="Phone" name="Phone" required />
        </div>
        <div class="form-group">
          <label for="RollNo">Roll No:</label>
          <input type="text" id="RollNo" name="RollNo" required />
        </div>
        <div class="form-group">
          <label for="Password">Password:</label>
          <input type="password" id="Password" name="Password" required />
        </div>
        <div class="form-group">
          <label for="Branch">Branch:</label>
          <input type="text" id="Branch" name="Branch" required />
        </div>
        <div class="form-group">
          <label for="Semester">Semester:</label>
          <input type="text" id="Semester" name="Semester" required />
        </div>
        <div class="form-group">
          <label for="PendingDues">Pending Dues:</label>
          <input type="text" id="PendingDues" name="PendingDues" required />
        </div>
        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </div>
  </body>
</html>
