<?php
session_start();
include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $sql = "SELECT * FROM super_admin WHERE ID=? AND Password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User authenticated
        $_SESSION['admin_id'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "<p class='error'>Invalid UserID or Password, Please Check before entering Again</p>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Super Admin Login</title>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Super Admin Login</h2>
            <form method="post" action="">
                <div class="input-container">
                    <label for="username"><i class="fa-solid fa-user-astronaut"></i></label>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="input-container">
                    <label for="password"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <p><?php echo $error; ?></p>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>
