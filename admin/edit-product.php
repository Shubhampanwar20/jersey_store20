<?php
session_start();
include '../includes/db.php';

if (!isset($_GET['id'])) {
    die("Product ID missing.");
}

$id = intval($_GET['id']);
$error = "";

// Get existing product info
$result = $conn->query("SELECT * FROM products WHERE id = $id");
if ($result->num_rows !== 1) {
    die("Product not found.");
}
$product = $result->fetch_assoc();

// Handle update form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    // Check if image was uploaded
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/$image");

        $conn->query("UPDATE products SET name='$name', price='$price', description='$desc', image='$image' WHERE id=$id");
    } else {
        $conn->query("UPDATE products SET name='$name', price='$price', description='$desc' WHERE id=$id");
    }

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Product</title>
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
    input[type="text"], input[type="number"], textarea, input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover {
      background: #0056b3;
    }
    .preview-img {
      display: block;
      margin: 10px 0;
      max-width: 100px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Edit Jersey</h2>
    <form method="POST" enctype="multipart/form-data">
      <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
      <input type="number" name="price" value="<?= $product['price'] ?>" step="0.01" required>
      <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea>
      
      <label>Current Image:</label><br>
      <img class="preview-img" src="../uploads/<?= $product['image'] ?>" alt="Current Image"><br>

      <label>Change Image:</label>
      <input type="file" name="image">

      <button type="submit">Update Product</button>
    </form>
  </div>
</body>
</html>
