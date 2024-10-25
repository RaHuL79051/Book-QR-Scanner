<?php
include '../connection.php';

$student_id = $_GET['id'];
$sql = "DELETE FROM allow_permissions WHERE UID = '$student_id'";

if ($conn->query($sql) === TRUE) {
    echo "Request rejected successfully! <a href='index.php'>Go back</a>";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
