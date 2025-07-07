<?php
session_start();
include 'includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($check->num_rows > 0) {
        $message = "Email already registered!";
    } else {
        $conn->query("INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')");
        $message = "Registration successful. You can now log in!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Jersey Store</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f4f4;
    }

    .register-box {
      width: 400px;
      margin: 100px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      text-align: center;
    }

    .register-box h2 {
      margin-bottom: 20px;
    }

    input {
      width: 90%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    button {
      background: #28a745;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      width: 95%;
    }

    button:hover {
      background: #218838;
    }

    .message {
      color: #d9534f;
      margin-top: 15px;
      font-weight: bold;
    }

    .success {
      color: #28a745;
    }

    p a {
      text-decoration: none;
      color: #007bff;
    }

    p a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="register-box">
  <h2>Create Your Account</h2>
  <form method="POST">
    <input type="text" name="fullname" placeholder="Full Name" required><br>
    <input type="email" name="email" placeholder="Email Address" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
  </form>

  <?php if ($message): ?>
    <p class="message <?= strpos($message, 'successful') !== false ? 'success' : '' ?>">
      <?= $message ?>
    </p>
  <?php endif; ?>

  <p>Already have an account? <a href="login.php">Login here</a>.</p>
</div>

</body>
</html>
