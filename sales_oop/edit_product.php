<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE Products SET product_name='$product_name', price='$price', quantity='$quantity' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Products WHERE id=$id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}
?>

<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    Product Name: <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>"><br>
    Price: <input type="text" name="price" value="<?php echo $product['price']; ?>"><br>
    Quantity: <input type="text" name="quantity" value="<?php echo $product['quantity']; ?>"><br>
    <input type="submit" value="Update Product">
</form>