<?php
// Establish connection to your MySQL database
include('../connection.php');

// Process form data
$name = $_POST['name'];
$author = $_POST['author'];
$isbn = $_POST['isbn'];
$title = $_POST['title'];
$uid = $_POST['uid'];
$date = $_POST['date'];

// Check if the book with the same ISBN is already issued to someone else
$check_sql = "SELECT * FROM requested_books WHERE ISBN = '$isbn'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
  // Book is already issued, show an error message
  echo "
  <!DOCTYPE html>
  <html lang='en'>
  <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Book Already Issued</title>
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

.error-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.error-box {
  background-color: #fff;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
  max-width: 400px;
}

.error-title {
  color: #e74c3c;
  font-size: 24px;
  margin-bottom: 1rem;
}

.error-message {
  font-size: 18px;
  color: #7f8c8d;
  margin-bottom: 2rem;
}

.back-button {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  background-color: #3498db;
  color: white;
  text-decoration: none;
  font-size: 16px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.back-button:hover {
  background-color: #2980b9;
}

    </style>
  </head>
  <body>
    <div class='error-container'>
      <div class='error-box'>
        <h1 class='error-title'>Oops! This Book is Already Issued</h1>
        <p class='error-message'>It looks like this book is currently issued to someone else. Please try again later.</p>
        <a href='./index.php' class='back-button'>Go Back to Dashboard</a>
      </div>
    </div>
  </body>
  </html>";
} else {
  // Book is not issued, proceed with the insertion
  $sql = "INSERT INTO requested_books (id, Student_ID, name, author, ISBN, Title, Date, Issued) 
          VALUES (NULL, '$uid', '$name', '$author', '$isbn', '$title', '$date', 0)";

  if ($conn->query($sql) === TRUE) {
    header("Location: ./index.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
