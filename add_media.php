<?php include 'db.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $type = $_POST['base_type'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("INSERT INTO media (name, base_type, stock) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $type, $stock);
    $stmt->execute();
    echo "Media added successfully.";
}
?>

<form method="POST">
    <h2>Add Culture Media</h2>
    Lot: <input type="text" name="name" required><br>
    Media: <input type="text" name="base_type"><br>
    Volume (ml): <input type="number" name="stock"><br>
    <input type="submit" value="Add Media">
</form>
