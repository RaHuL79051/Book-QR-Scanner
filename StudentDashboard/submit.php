<?php
include('../connection.php');
// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO requested_books (Name, Author, ISBN, Title, Date, Issued) VALUES (?, ?, ?, ?, NOW(), 0)");
$stmt->bind_param("ssss", $name, $author, $isbn, $title);

// Set parameters and execute
$name = $_POST["name"];
$author = $_POST["author"];
$isbn = $_POST["isbn"];
$title = $_POST["title"];

if ($stmt->execute() === TRUE) {
  // echo "New record created successfully";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
