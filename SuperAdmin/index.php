<?php include '../connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1, h2, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        form {
            margin: 20px 0;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 999;
        }
        .content {
            text-align: center;
            color: white;
            z-index: 1000;
        }

        .content h1 {
            font-size: 3rem;
            color: #ff4c4c; /* Red accent color */
        }

        .content p {
            font-size: 1.5rem;
            margin-top: 10px;
        }

        .moving-accent {
            position: absolute;
            width: 200px;
            height: 5px;
            background: linear-gradient(90deg, transparent, #ff4c4c, transparent);
            animation: moveAccent 2s linear infinite;
            z-index: 999;
            bottom: 20%;
        }

        @keyframes moveAccent {
            0% {
                left: 0;
            }
            100% {
                left: 100%;
                transform: translateX(-100%);
            }
        }
    </style>
</head>
<body>
<div id="overlay">
        <div class="content">
            <h1>This Page is Under Maintenance</h1>
            <p>We'll be back soon!</p>
        </div>
        <div class="moving-accent"></div>
    </div>
    <h1>Super Admin Dashboard</h1>

    <h2>Manage Students</h2>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Phone</th>
            <th>Roll No</th>
            <th>Branch</th>
            <th>Semester</th>
            <th>Pending Dues</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM user_login";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["Student_ID"] . "</td>
                        <td>" . $row["StudentName"] . "</td>
                        <td>" . $row["Phone"] . "</td>
                        <td>" . $row["RollNo"] . "</td>
                        <td>" . $row["Branch"] . "</td>
                        <td>" . $row["Semester"] . "</td>
                        <td>" . $row["PendingDues"] . "</td>
                        <td><a href='remove_student.php?id=" . $row["Student_ID"] . "'>Remove</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No students found.</td></tr>";
        }
        ?>
    </table>

    <h2>Add Student</h2>
    <form action="add_student.php" method="post">
        <input type="text" name="studentName" placeholder="Student Name" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="text" name="rollNo" placeholder="Roll No" required>
        <input type="text" name="branch" placeholder="Branch" required>
        <input type="text" name="semester" placeholder="Semester" required>
        <input type="text" name="pendingDues" placeholder="Pending Dues" required>
        <button type="submit">Add Student</button>
    </form>

    <h2>Profile Edit Requests</h2>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM allow_permissions WHERE Permission = 0"; // 0 means pending
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["UID"] . "</td>
                        <td>
                            <a href='approve_request.php?id=" . $row["UID"] . "'>Approve</a> | 
                            <a href='reject_request.php?id=" . $row["UID"] . "'>Reject</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No pending requests.</td></tr>";
        }
        ?>
    </table>

    <h2>Add Librarian</h2>
    <form action="add_librarian.php" method="post">
        <input type="text" name="name" placeholder="Librarian Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="text" name="uid" placeholder="UID" required>
        <input type="text" name="department" placeholder="Department" required>
        <input type="date" name="joined_date" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Add Librarian</button>
    </form>

    <h2>View Issuance History</h2>
    <table>
        <tr>
            <th>UID</th>
            <th>Student Name</th>
            <th>Book Name</th>
            <th>Issued Date</th>
            <th>Return Date</th>
            <th>ISBN</th>
        </tr>
        <?php
        $sql = "SELECT * FROM history";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["UID"] . "</td>
                        <td>" . $row["Student_name"] . "</td>
                        <td>" . $row["Book_name"] . "</td>
                        <td>" . $row["Issued_date"] . "</td>
                        <td>" . $row["Return_date"] . "</td>
                        <td>" . $row["ISBN"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No history records found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
