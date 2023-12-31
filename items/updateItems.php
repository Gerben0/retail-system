<?php

// TO DO: Use the Model and Controller files for the below query

include_once(__DIR__ . '/../includes/dbconnect.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

$stmt = $pdo->prepare("SELECT * FROM items WHERE id = :id");
$data = [':id' => $id];
$stmt->execute($data);
$items = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM taxes");
$stmt->execute();
$taxes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" /> 
    <link rel="stylesheet" href="createItems.css">
</head>
<body>
    
    <div class="backButtonItems">
        <form action="itemsIndex.php" method="post">
            <button type="submit" name="backButton" id="backButton" value="backButton" class="m-3 bButton">Back</button>
        </form>
    </div>

    <h1 class="mt-3 ps-4">Update item</h1>

    <form action="ItemsController.php" method="post" class="mt-3">
        <div class="ps-4 createItemOverview">
            <div>
                <input type="hidden" id="itemId" name="itemId" value="<?= $items['id'] ?>">
            </div>
            <div class="mb-3 itemTitle">
                <h3>Title</h3>
                <input type="text" id="itemTitle" name="itemTitle" class="form-control" placeholder="" value="<?= $items['title'] ?>">
            </div>
            <div class ="mb-3 itemBarcode"> <!-- TO DO: Create error when input is longer than 13 digits (or disable using JS?) -->
                <h3>Barcode</h3>
                <input type="number" id="itemBarcode" name="itemBarcode" class="form-control" placeholder="" value="<?= $items['barcode'] ?>">
            </div>
            <div class="mb-3 itemInventory">
                <h3>Inventory</h3>
                <input type="number" id="itemInventory" name="itemInventory" class="form-control" placeholder="" value="<?= $items['inventory'] ?>">
            </div>
            <div class="mb-3 itemRetailPrice"> <!-- TO DO: convert dot to comma (or the other way around?) -->
                <h3>Retail price</h3>
                <input type="number" id="itemRetailPrice" class="form-control" name="itemRetailPrice" step="0.01" placeholder="" value="<?= $items['retail_price'] ?>">
            </div>
            <div class="mb-3 itemDefaultCost"> <!-- TO DO: convert dot to comma (or the other way around?) -->
                <h3>Default cost</h3> 
                <input type="number" id="itemDefaultCost" class="form-control" name="itemDefaultCost" step="0.01" placeholder="" value="<?= $items['default_cost'] ?>">
            </div>
            <div class="mb-3 itemTax"> 
                <h3>Tax rate</h3>
                <select name="itemTax" id="itemTax">
                    <?php foreach ($taxes as $tax): ?>
                        <option value="<?= htmlspecialchars($tax['name'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?= htmlspecialchars($tax['percentage'], ENT_QUOTES, 'UTF-8'); ?>%
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 itemDescription">
                <h3>Description</h3>
                <textarea name="itemDescription" id="itemDescription" class="form-control" placeholder="" value="<?= $items['description'] ?>"><?= $items['description'] ?></textarea>
            </div>
            <div class="mb-3 itemVendor"> <!-- TO DO: make option values dynamic from options set in vendor table -->
                <h3>Vendor</h3>
                <select class="mb-3 form-select custom-select" name="itemVendor" id="itemVendor">
                    <option value="<?= $items['vendor'] ?>"><?= $items['vendor'] ?></option>
                </select>
            </div>

        </div>

        <div class="ps-4 addItem">
            <input type="submit" id="updateItem" name="updateItem" class="btn btn-primary addItem" value="Save changes">
        </div>

        <div class="deleteButton">
            <input type="submit" id="deleteItem" name="deleteItem" class="deleteItem" value="Delete item">
        </div>

    </form>


    <!-- Scripts -->
<script src="itemScripts.js"></script>     
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>   

</body>
</html>