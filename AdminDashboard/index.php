<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/b5b6622958.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar">
    <h1 id="Menu"><i class="fa-solid fa-bars"></i> Menu</h1>
    <h2>Scan Book QR</h2>
    <div class="Profile">
        <i class="fa-solid fa-bell BellNotification" style="content:<?php $count ?>;"></i>
        <img src="./profile-1.jpg" alt="" id="UserProfile">
    </div>
</nav>
<section class="MainSection">
    <div class="LeftSidebar">
        <li onclick="window.location.href = './index.php'" class="Active">
            <i class="fa-solid fa-hand"></i>
            Requests
        </li>
        <li onclick="window.location.href = './StudentPage.php'">
            <i class="fa-solid fa-graduation-cap"></i> Student List
        </li>
        <li onclick="window.location.href = './Librarian.php'">
            <i class="fa-solid fa-chalkboard-user"></i> Librarian List
        </li>
        <li onclick="window.location.href = './Generate_QR_Code/index.html'">
            <i class="fa-solid fa-qrcode"></i> Create QR Code
        </li>
        <div class="Attribute">
          <p> &copy Rahul Saxena</p>
        </div>
    </div>
    <div class="RightSidebar">
        <?php
        // Database connection
        include('../connection.php');
        $count=0;

        // Check if the accept button is clicked
        if (isset($_POST['acceptBook'])) {
            $bookId = $_POST['bookId'];
            // Update Issued column to 1 for the selected book
            $sql = "UPDATE requested_books SET Issued = 1 WHERE id = $bookId";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Book accepted successfully!');</script>";
            } else {
                echo "<script>alert('Error accepting book: " . $conn->error . "');</script>";
            }
        }


$sql = "SELECT * FROM requested_books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="BooksTable">';
    echo '<tr><th>ID</th><th>Name</th><th>Author</th><th>ISBN</th><th>Title</th><th>Date</th><th>Action</th></tr>';
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row['Issued'] == 0) {
            $count+=1   ;
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["author"] . "</td><td>" . $row["ISBN"] . "</td><td>" . $row["Title"] . "</td><td>" . $row["Date"] . "</td>";
            echo '<td><form method="post"><button class="AcceptButton" type="submit" name="acceptBook" value="accept" onclick="return confirm(\'Are you sure you want to accept this book?\')">Accept</button><input type="hidden" name="bookId" value="' . $row['id'] . '"></form></td></tr>';
        }
    }
    echo "</table>";
} else {
    echo "";
}
        $conn->close();
        ?>
    </div>
</section>

<!-- User Profile -->

<div class="UserProfileCard">
    <li id="showProfile" onclick="window.location.href = './showProfile.php'"><i class="fa-solid fa-user"></i> Show Profile</li>
    <li id="LogOut" onclick="window.location.href='../landing%20page/LibrarianLogin/index.php'">
        <i class="fa-solid fa-right-from-bracket"></i> Log Out
    </li>
</div>
<script src="script.js"></script>
</body>
</html>
