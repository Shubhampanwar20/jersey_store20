<?php
session_start();
$_SESSION['cart'] = []; // Clear the cart
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmed</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 0;
    }

    .confirmation-container {
      max-width: 600px;
      margin: 100px auto;
      background: #fff;
      padding: 40px;
      text-align: center;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #28a745;
      font-size: 36px;
      margin-bottom: 20px;
    }

    p {
      font-size: 18px;
      margin-bottom: 30px;
    }

    .home-btn {
      background: #007bff;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      text-decoration: none;
      transition: background 0.3s;
    }

    .home-btn:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

  <div class="confirmation-container">
    <h1>✅ Order Confirmed!</h1>
    <p>Thank you for shopping with us. Your jersey order has been placed successfully.</p>
    <a href="index.php" class="home-btn">🏠 Go to Home</a>
  </div>

</body>
</html>
