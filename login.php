<?php
include 'includes/db.php'; // Connect to DB
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - Jersey Store</title>
  <link rel="stylesheet" href="css/styles.css" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-image: url('images/msn.jpg'); /* ✅ Correct path */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }

    .container {
      max-width: 420px;
      margin: 100px auto;
      background: rgba(255, 255, 255, 0.95); /* Transparent white */
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px 14px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    input[type="submit"] {
      width: 100%;
      background-color: #007bff;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }

    p {
      text-align: center;
      margin-top: 15px;
    }

    a {
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login to Your Account</h2>

    <?php if ($error): ?>
      <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post" action="">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
  </div>
</body>
</html>
