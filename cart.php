<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }
    header("Location: cart.php");
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$productDetails = [];

if (!empty($cart)) {
    $ids = implode(',', array_keys($cart));
    $query = "SELECT * FROM products WHERE id IN ($ids)";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $productDetails[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
    }

    header {
      background-color: #000;
      color: #fff;
      padding: 15px;
      text-align: center;
    }

    .cart-container {
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: center;
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }

    img {
      width: 100px;
      border-radius: 5px;
    }

    .total-row {
      font-weight: bold;
    }

    .checkout-btn {
      background: #007bff;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
      float: right;
    }

    .checkout-btn:hover {
      background-color: #0056b3;
    }

    .empty {
      text-align: center;
      font-size: 20px;
      margin: 50px 0;
    }
  </style>
</head>
<body>

<header>
  <h1>🛒 Your Cart</h1>
</header>

<div class="cart-container">
  <?php if (empty($cart)): ?>
    <p class="empty">Your cart is empty.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Product</th>
          <th>Image</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; ?>
        <?php foreach ($productDetails as $product): 
            $id = $product['id'];
            $qty = $cart[$id];
            $subtotal = $product['price'] * $qty;
            $total += $subtotal;
        ?>
        <tr>
          <td><?= $product['name'] ?></td>
          <td><img src="uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>"></td>
          <td>₹<?= $product['price'] ?></td>
          <td><?= $qty ?></td>
          <td>₹<?= $subtotal ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="total-row">
          <td colspan="4">Total</td>
          <td>₹<?= $total ?></td>
        </tr>
      </tbody>
    </table>

    <a href="checkout.php">
      <button class="checkout-btn">Proceed to Checkout</button>
    </a>
  <?php endif; ?>
</div>

</body>
</html>
