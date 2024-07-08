<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    $sql = "SELECT * FROM Products WHERE id=$id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();

    $total_price = $product['price'] * $quantity;

    echo "Total Price: $" . $total_price;

    echo '<form method="post" action="payment.php">
            <input type="hidden" name="id" value="'.$id.'">
            <input type="hidden" name="quantity" value="'.$quantity.'">
            <input type="hidden" name="total_price" value="'.$total_price.'">
            Enter Payment: <input type="text" name="payment"><br>
            <input type="submit" value="Pay">
          </form>';
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Products WHERE id=$id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

?>

<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    Product Name: <?php echo $product['product_name']; ?><br>
    Price: <?php echo $product['price']; ?><br>
    Quantity: <input type="number" name="quantity" min="1" max="<?php echo $product['quantity']; ?>" required><br>
    <input type="submit" value="Calculate Total">
</form>
