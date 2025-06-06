<!DOCTYPE html>
<html>
<head>
    <title>Media & Supplements Dashboard</title>
    <style>
        .section {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 15px;
        }
    </style>
</head>
<body>

<h1>Media and Supplements Dashboard</h1>

<div class="section">
    <h2>Add Media</h2>
    <?php include 'add_media.php'; ?>
</div>

<div class="section">
    <h2>Add Supplement</h2>
    <?php include 'add_supplement.php'; ?>
</div>

<div class="section">
    <h2>Link Supplement to Media</h2>
    <?php include 'link_supplement.php'; ?>
</div>

<div class="section">
    <h2>View Media</h2>
    <?php include 'view_media.php'; ?>
</div>

</body>
</html>
