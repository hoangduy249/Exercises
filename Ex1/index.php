<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Laptop Management</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
        button { padding: 4px 8px; }
    </style>
</head>
<body>
<h2>Add new Laptop</h2>

<form action="" method="POST">
    Company: <input type="text" name="brand" required><br>
    Model: <input type="text" name="model" required><br>
    CPU: <input type="text" name="processor"><br>
    RAM (GB): <input type="number" name="ram"><br>
    Disk: <input type="text" name="storage"><br>
    Price: <input type="number" step="0.01" name="price"><br>
    Quantity: <input type="number" name="quantity"><br>
    Year manufacture: <input type="number" name="release_year"><br>
    Describe: <input type="text" name="description"><br>
    <button type="submit" name="save">Save</button>
</form>

<?php
if (isset($_POST['save'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $processor = $_POST['processor'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $release_year = $_POST['release_year'];
    $description = $_POST['description'];

    $sql = "INSERT INTO laptops (brand, model, processor, ram, storage, price, quantity, release_year, description) 
            VALUES ('$brand', '$model', '$processor', '$ram', '$storage', '$price', '$quantity', '$release_year', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Added laptop Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<hr>
<h2>Danh sách Laptop</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Company</th>
        <th>Model</th>
        <th>CPU</th>
        <th>RAM</th>
        <th>Disk</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Year Manufacture</th>
        <th>Describe</th>
        <th>Edit/th>
        <th>Delete</th>
    </tr>

<?php
$result = $conn->query("SELECT * FROM laptops");
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['brand']."</td>
        <td>".$row['model']."</td>
        <td>".$row['processor']."</td>
        <td>".$row['ram']." GB</td>
        <td>".$row['storage']."</td>
        <td>".$row['price']."</td>
        <td>".$row['quantity']."</td>
        <td>".$row['release_year']."</td>
        <td>".$row['description']."</td>
        <td><a href='edit.php?id=".$row['id']."'>Edit</a></td>
        <td><a href='delete.php?id=".$row['id']."'>Delete</a></td>
    </tr>";
}
?>
</table>

</body>
</html>
