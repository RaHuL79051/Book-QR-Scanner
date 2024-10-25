<?php
session_start();

include('../connection.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the librarian ID from the session
    $librarianId = $_SESSION['librarian_id'] ?? null;

    if ($librarianId) {
        // Get form data
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $department = $conn->real_escape_string($_POST['department']);
        $joined_date = $conn->real_escape_string($_POST['joined_date']);
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
        
        // Update query
        $sql = "UPDATE liberarian_login 
                SET Name='$name', Email='$email', Phone='$phone', Department='$department', 
                    Joined_date='$joined_date', username='$username', password='$password' 
                WHERE id='$librarianId'";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Librarian information updated successfully.');</script>";
            header("Location: ./showProfile.php");
        } else {
            echo "<script>alert('Error updating librarian information: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Librarian ID not found in session.');</script>";
    }
}

$conn->close();
?>
