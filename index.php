<?php
// Turn on error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
include 'includes/db.php';
session_start();

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Run query and check result
$result = $conn->query("SELECT * FROM products");
if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Jersey Store</title>
  <link rel="stylesheet" href="css/styles.css"> <!-- ✅ Corrected path -->
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #000;
      color: #fff;
      padding: 15px;
      text-align: center;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      margin: 0 15px;
      font-weight: bold;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      padding: 40px;
    }

    .product-card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      transition: transform 0.3s;
    }

    .product-card:hover {
      transform: translateY(-5px);
    }

    .product-card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 8px;
    }

    .product-card h2 {
      font-size: 20px;
      margin: 10px 0 5px;
    }

    .product-card p {
      font-size: 18px;
      color: #007b5e;
    }

    .product-card button {
      background: #007bff;
      color: #fff;
      padding: 10px 20px;
      border: none;
      margin-top: 10px;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }

    .product-card button:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

  <header>
    <h1>⚽ Football Jersey Store</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="cart.php">Cart</a>
      <a href="login.php">Login</a>
      <a href="admin/login.php">Admin Login</a>
      <a href="register.php">Register</a>
    </nav>
  </header>

  <div class="product-grid">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="product-card">
        <img src="uploads/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
        <h2><?= $row['name'] ?></h2>
        <p>₹<?= $row['price'] ?></p>
        <form method="POST" action="cart.php">
          <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
          <button type="submit">Add to Cart</button>
        </form>
      </div>
    <?php endwhile; ?>
  </div>

</body>
</html>
