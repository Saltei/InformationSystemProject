<?php include 'db.php'; ?>

<h2>Media & Supplement Compositions</h2>
<?php
$result = $conn->query("SELECT * FROM media");

while ($media = $result->fetch_assoc()) {
    echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px'>";
    echo "<strong>{$media['name']}</strong> ({$media['base_type']}) - Stock: {$media['stock']} ml";

    $id = $media['media_id'];
    $supps = $conn->query("
        SELECT s.name, s.stock AS supplement_stock, s.expiration_date, ms.amount_used 
        FROM media_supplements ms
        JOIN supplements s ON s.supplement_id = ms.supplement_id
        WHERE ms.media_id = $id
    ");

    if ($supps->num_rows > 0) {
        echo "<ul>";
        while ($s = $supps->fetch_assoc()) {
            echo "<li>
                <strong>{$s['name']}</strong> - Used: {$s['amount_used']} 
                | Supplement Stock: {$s['supplement_stock']} 
                | Expires: {$s['expiration_date']}
            </li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No supplements added yet.</p>";
    }

    echo "</div>";
}
?>
