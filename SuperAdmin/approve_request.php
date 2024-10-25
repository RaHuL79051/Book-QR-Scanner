<?php
include '../connection.php';

$student_id = $_GET['id'];
$sql = "UPDATE allow_permissions SET Permission = 1 WHERE UID = '$student_id'";

if ($conn->query($sql) === TRUE) {
    echo "Request approved successfully! <a href='index.php'>Go back</a>";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
