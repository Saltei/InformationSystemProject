<?php include 'db.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $expiration_date = $_POST['expiration_date'];

    $stmt = $conn->prepare("INSERT INTO supplements (name, stock, expiration_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $stock, $expiration_date);

    if ($stmt->execute()) {
        echo "Supplement added.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


<form method="POST">
    <h2>Add Supplement</h2>
    Name: <input type="text" name="name" required><br>
    Stock (ml or mg): <input type="number" name="stock" step="any"><br>
    Expiration Date: 
    <input type="date" name="expiration_date" required>
    <small>(Format: YYYY-MM-DD)</small><br>
    <input type="submit" value="Add Supplement">
</form>

