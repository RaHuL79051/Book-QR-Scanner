<?php
session_start();
include('../connection.php');
$librarianId = $_SESSION['librarian_id'] ?? null;
if($librarianId) { 
    $sql = "SELECT * FROM liberarian_login WHERE UID = $librarianId"; 
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) { 
        $librarianInfo = $result->fetch_assoc(); 
    } 
} else{
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Librarian Registration</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Form Container */
        .form-container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Button */
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #333;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Librarian Registration</h2>
        <form action="updateLibrairan.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $librarianInfo['Name']; ?>" />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo $librarianInfo['Email']; ?>" />
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required value="<?php echo $librarianInfo['Phone']; ?>" />
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" required value="<?php echo $librarianInfo['Department']; ?>" />
            </div>
            <div class="form-group">
                <label for="joined_date">Joined Date:</label>
                <input type="text" id="joined_date" name="joined_date" required value="<?php echo $librarianInfo['Joined_date']; ?>" />
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required value="<?php echo $librarianInfo['username']; ?>" />
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" required value="<?php echo $librarianInfo['password']; ?>" />
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
