<?php
include '../connection.php';

$studentName = $_POST['studentName'];
$phone = $_POST['phone'];
$rollNo = $_POST['rollNo'];
$branch = $_POST['branch'];
$semester = $_POST['semester'];
$pendingDues = $_POST['pendingDues'];

$sql = "INSERT INTO user_login (StudentName, Phone, RollNo, Branch, Semester, PendingDues) 
        VALUES ('$studentName', '$phone', '$rollNo', '$branch', '$semester', '$pendingDues')";

if ($conn->query($sql) === TRUE) {
    echo "New student added successfully! <a href='index.php'>Go back</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
