<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
    <style>
      .Data_Table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 1.2rem;
      }

      .Data_Table th, .Data_Table td {
        border: 1px solid #ddd;
        padding: 8px;
      }

      .Data_Table th {
        background-color: #f2f2f2;
        text-align: left;
      }

      .Data_Table tr:nth-child(even) {
        background-color: none;
      }

      .Data_Table tr:hover {
        background-color: ;
      }

    </style>
    <script
      src="https://kit.fontawesome.com/b5b6622958.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <nav class="navbar">
      <h1 id="Menu"><i class="fa-solid fa-bars"></i> Menu</h1>
      <h2>Scan Book QR</h2>
      <div class="Profile">
        <i class="fa-solid fa-bell BellNotification"></i>
        <img src="./profile-1.jpg" alt="" id="UserProfile" />
      </div>
    </nav>
    <section class="MainSection">
      <div class="LeftSidebar">
        <li onclick="window.location.href = './index.php'">
          <i class="fa-solid fa-hand"></i>
          Requests
        </li>
        <li onclick="window.location.href = './StudentPage.php'">
          <i class="fa-solid fa-graduation-cap"></i> Student List
        </li>
        <li onclick="window.location.href = './Librarian.php'" class="Active">
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

        // Fetch data from the table
        $sql = "SELECT id,username  FROM liberarian_login";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="Data_Table">';
            echo '<tr><th>ID</th><th>Name</th></tr>';
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
      </div>
    </section>

    <!-- User Profile -->

    <div class="UserProfileCard">
      <li id="showProfile" onclick="window.location.href = './showProfile.php'"><i class="fa-solid fa-user"></i> Show Profile</li>
      <li
        id="LogOut"
        onclick="window.location.href='../LandingPage/StudentLogin/index.php'"
      >
        <i class="fa-solid fa-right-from-bracket"></i> Log Out
      </li>
    </div>
    <script src="script.js"></script>
  </body>
</html>
