<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM Products";
$result = $conn->query($sql);

?>

<a href="add_product.php">Add Product</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['product_name']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td><?php echo $row['quantity']; ?></td>
        <td>
            <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a href="delete_product.php?id=<?php echo $row['id']; ?>">Delete</a>
            <a href="buy_product.php?id=<?php echo $row['id']; ?>">Buy</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php $conn->close(); ?>