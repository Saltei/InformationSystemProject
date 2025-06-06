<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $media_id = $_POST['media_id'];
    $supplement_id = $_POST['supplement_id'];
    $amount_used = $_POST['amount_used'];

    // Check current stock
    $checkStock = $conn->prepare("SELECT stock FROM supplements WHERE supplement_id = ?");
    $checkStock->bind_param("i", $supplement_id);
    $checkStock->execute();
    $result = $checkStock->get_result();
    $row = $result->fetch_assoc();
    $currentStock = $row['stock'];
    $checkStock->close();

    if ($currentStock > 0) {
        // Link supplement to media
        $stmt = $conn->prepare("INSERT INTO media_supplements (media_id, supplement_id, amount_used) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $media_id, $supplement_id, $amount_used);
        $stmt->execute();
        $stmt->close();

        // Reduce supplement stock by 1
        $update = $conn->prepare("UPDATE supplements SET stock = stock - 1 WHERE supplement_id = ?");
        $update->bind_param("i", $supplement_id);
        $update->execute();
        $update->close();

        echo "Supplement linked to media. Stock updated.";
    } else {
        echo "Error: Not enough stock to link this supplement.";
    }
}
?>

<h2>Link Supplement to Media</h2>
<form method="POST">
    Media:
    <select name="media_id">
        <?php
        $media = $conn->query("SELECT * FROM media");
        while ($m = $media->fetch_assoc()) {
            echo "<option value='{$m['media_id']}'>{$m['name']}</option>";
        }
        ?>
    </select><br>

    Supplement:
    <select name="supplement_id">
        <?php
        $supps = $conn->query("SELECT * FROM supplements");
        while ($s = $supps->fetch_assoc()) {
            echo "<option value='{$s['supplement_id']}'>{$s['name']} (Stock: {$s['stock']})</option>";
        }
        ?>
    </select><br>

    Amount Used: <input type="text" name="amount_used" placeholder="e.g. 10%, 2 mM"><br>
    <input type="submit" value="Link Supplement">
</form>
