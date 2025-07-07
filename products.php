<?php
include 'includes/db.php';
session_start();

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Jerseys</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class="container">
    <h2>⚽ Available Jerseys</h2>

    <div class="product-grid">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="product-card">
          <img src="uploads/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
          <h3><?= $row['name'] ?></h3>
          <p>₹<?= $row['price'] ?></p>
          <form method="post" action="cart.php">
            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
            <button type="submit" name="add_to_cart" class="btn-cart">Add to Cart</button>
          </form>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
