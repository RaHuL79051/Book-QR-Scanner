<?php
// Database connection
include('../connection.php');

// Start session to check for a logged-in librarian
session_start();

// Assuming a librarian ID is stored in the session after login
$librarianId = $_SESSION['librarian_id'] ?? null;
// echo $librarianId;
$librarianInfo = []; if ($librarianId) { $sql = "SELECT * FROM liberarian_login
WHERE UID = $librarianId"; $result = $conn->query($sql); if ($result->num_rows >
0) { $librarianInfo = $result->fetch_assoc(); } else { echo "No information
found for the specified librarian."; } } else { echo "You are not logged in."; }
$conn->close(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Librarian Profile</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <style>
      /* Global Styles */
      body {
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 0;
      }

      /* Profile Container */
      .profile-container {
        width: 60%;
        max-width: 800px;
        margin: 50px auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        text-align: center;
      }

      .profile-container h2 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #333;
      }

      /* Profile Image */
      .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto 20px;
        background-color: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        color: #555;
      }

      /* Profile Information */
      .profile-info {
        text-align: left;
        margin-top: 20px;
      }

      .profile-info p {
        font-size: 18px;
        color: #555;
        margin: 12px 0;
      }

      .profile-info p i {
        margin-right: 10px;
        color: #666;
      }

      /* Button */
      button {
        margin-top: 20px;
        padding: 12px 25px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        background-color: #5a67d8;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
      }

      button:hover {
        background-color: #434190;
      }
    </style>
  </head>
  <body>
    <div class="profile-container">
      <div class="profile-image">
        <i class="fa-solid fa-user"></i>
      </div>
      <h2>Librarian Profile</h2>
      <?php if (!empty($librarianInfo)) { ?>
      <div class="profile-info">
        <p>
          <i class="fa-solid fa-user"></i> <strong>Name:</strong>
          <?php echo htmlspecialchars($librarianInfo['Name']); ?>
        </p>
        <p>
          <i class="fa-solid fa-envelope"></i> <strong>Email:</strong>
          <?php echo htmlspecialchars($librarianInfo['Email']); ?>
        </p>
        <p>
          <i class="fa-solid fa-phone"></i> <strong>Phone:</strong>
          <?php echo htmlspecialchars($librarianInfo['Phone']); ?>
        </p>
        <p>
          <i class="fa-solid fa-building"></i> <strong>Department:</strong>
          <?php echo htmlspecialchars($librarianInfo['Department']); ?>
        </p>
        <p>
          <i class="fa-solid fa-calendar"></i> <strong>Joined On:</strong>
          <?php echo htmlspecialchars($librarianInfo['Joined_date']); ?>
        </p>
        <p>
          <i class="fa-solid fa-user-circle"></i> <strong>Username:</strong>
          <?php echo htmlspecialchars($librarianInfo['username']); ?>
        </p>
      </div>
      <?php } else { ?>
      <p>No profile information available.</p>
      <?php } ?>
      <button onclick="window.location.href='./EditProfile.php'">
        Edit Profile
      </button>
    </div>
  </body>
</html>
