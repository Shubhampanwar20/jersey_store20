<?php
session_start();
include '../includes/db.php';

// Admin login check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
  exit();
}

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$result = $conn->query("SELECT * FROM products");

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/styles.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1000px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .admin-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .admin-header h2 {
      margin: 0;
    }

    .admin-header a {
      background: #007bff;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 5px;
      margin-left: 10px;
    }

    .admin-header a:hover {
      background: #0056b3;
    }

    .admin-table {
      width: 100%;
      border-collapse: collapse;
    }

    .admin-table th, .admin-table td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }

    .admin-table th {
      background: #eee;
    }

    .admin-actions a {
      margin-right: 8px;
      text-decoration: none;
      color: white;
      background: #28a745;
      padding: 6px 12px;
      border-radius: 4px;
      font-size: 14px;
    }

    .admin-actions a.delete {
      background: red;
    }

    img {
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="admin-header">
      <h2>Admin Dashboard</h2>
      <div>
        <a href="add-product.php">+ Add Product</a>
      </div>
    </div>

    <table class="admin-table">
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><img src="../uploads/<?= $row['image'] ?>" width="60"></td>
          <td><?= $row['name'] ?></td>
          <td>₹<?= $row['price'] ?></td>
          <td><?= $row['description'] ?></td>
          <td class="admin-actions">
            <a href="edit-product.php?id=<?= $row['id'] ?>">Edit</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
