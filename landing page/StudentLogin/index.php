<?php
// Start session for user authentication
session_start();
include('../../connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_login WHERE student_id='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Store user information in session variables
        $_SESSION['studentname'] = $row['StudentName'];
        $_SESSION['student_id'] = $row['Student_ID'];
        header("Location: ../../StudentDashboard/index.php");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student ERP Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="post" id="login-form" class="login-form" autocomplete="off" role="main" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1 class="a11y-hidden">Student ERP Login</h1>
        <div>
            <label class="label-email">
                <input type="text" class="text" name="student_id" placeholder="Student ID" tabindex="1" required />
                <span class="required">Student ID</span>
            </label>
        </div>
        <input type="checkbox" name="show-password" class="show-password a11y-hidden" id="show-password" tabindex="3" />
        <label class="label-show-password" for="show-password">
            <span>Show Password</span>
        </label>
        <div>
            <label class="label-password">
                <input type="password" class="text" name="password" placeholder="Password" tabindex="2" required />
                <span class="required">Password</span>
            </label>
        </div>
        <input type="submit" value="Log In" />
        <div class="email">
            <a href="#">Forgot password?</a>
        </div>
        <figure aria-hidden="true">
            <div class="person-body"></div>
            <div class="neck skin"></div>
            <div class="head skin">
                <div class="eyes"></div>
                <div class="mouth"></div>
            </div>
            <div class="hair"></div>
            <div class="ears"></div>
            <div class="shirt-1"></div>
            <div class="shirt-2"></div>
        </figure>
    </form>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            var studentId = document.querySelector('input[name="student_id"]').value;
            var password = document.querySelector('input[name="password"]').value;
            if (studentId.trim() === '' || password.trim() === '') {
                event.preventDefault();
                alert('Please fill in both Student ID and Password fields.');
            }
        });
    </script>
</body>

</html>
