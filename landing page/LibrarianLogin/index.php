<?php
session_start(); // Start session for user authentication
include('../../connection.php');

// Step 7: Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM liberarian_login WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $librarian = $result->fetch_assoc();

        // Store the librarian ID in the session
        $_SESSION['librarian_id'] = $librarian['UID'];
        header("Location: ../../AdminDashboard/index.php");
        echo $sql;
        exit();
    } else {
        // $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="./style.css">
    <title>Librarian login Registration Form</title>
</head>
<body>
    <div class="container front">
        <div class="top">
            <span>Librarian Login</span>
        </div>
        <div class="form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="inputBox inputBoxFront">
                    <label><i class="fa-solid fa-user"></i></label>
                    <input type="text" placeholder="Username" name="username" class="input" required>
                </div>
                <div class="inputBox inputBoxFront">
                    <label><i class="fa-solid fa-lock"></i></label>
                    <input type="password" placeholder="Password" name="password" class="input" required>
                </div>
                <button type="submit" class="btn">Log in</button>
            </form>
            <?php if(isset($error)) echo $error; ?>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
