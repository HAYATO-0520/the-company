<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $payment = $_POST['payment'];

    // 製品情報を取得
    $sql = "SELECT * FROM Products WHERE id=$id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();

    // 支払い金額の確認
    if ($payment >= $total_price) {
        // 在庫の更新
        $new_quantity = $product['quantity'] - $quantity;
        if ($new_quantity >= 0) {
            $update_sql = "UPDATE Products SET quantity=$new_quantity WHERE id=$id";
            if ($conn->query($update_sql) === TRUE) {
                $change = $payment - $total_price;
                echo "Payment successful! Your change is: $" . $change;
                echo "<br>Remaining stock: " . $new_quantity;
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Not enough stock available.";
        }
    } else {
        echo "Insufficient payment. Total price is $" . $total_price;
    }
} else {
    echo "Invalid request.";
}
?>