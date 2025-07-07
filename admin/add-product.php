<?php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];

  $image = $_FILES['image']['name'];
  $temp = $_FILES['image']['tmp_name'];

  move_uploaded_file($temp, "../uploads/$image");

  $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("sdss", $name, $price, $description, $image);
  $stmt->execute();

  header("Location: dashboard.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Add Product</title>
  <link rel="stylesheet" href="../css/styles.css">
  <style>
    .form-container {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    form input[type="text"],
    form input[type="number"],
    form textarea,
    form input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    form button {
      width: 100%;
      padding: 10px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }
    form button:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Add New Jersey</h2>
    <form method="POST" enctype="multipart/form-data">
      <input type="text" name="name" placeholder="Product Name" required>
      <input type="number" name="price" step="0.01" placeholder="Price (₹)" required>
      <textarea name="description" placeholder="Short Description" required></textarea>
      <input type="file" name="image" accept="image/*" required>
      <button type="submit">Add Product</button>
    </form>
  </div>
</body>
</html>
