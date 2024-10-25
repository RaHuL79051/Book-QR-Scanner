<?php
include '../connection.php';

$student_id = $_GET['id'];
$sql = "DELETE FROM user_login WHERE Student_ID = '$student_id'";

if ($conn->query($sql) === TRUE) {
    echo "Student removed successfully! <a href='index.php'>Go back</a>";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
