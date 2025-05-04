<?php
require_once __DIR__ . '/../model/ProductDAO.php';


$productDAO = new ProductDAO();
$products = $productDAO->getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<h1 style="text-align: center">Product Database</h1>
<p style="text-align: center; font-size: 30px;">Listing products currently available in stock!</p>

<div class="container">
    <div class="col">
        <form action="../controller.php" method="GET">
            <button class="btn btn-primary" type="submit" name="page" value="ADD">Add A Product</button>
            <button class="btn btn-warning" type="submit" name="page" value="UPDATE"
                    onclick="return confirm('Are you sure you want to update this product?');">Update Product</button>
            <button class="btn btn-danger" type="submit" name="page" value="DELETE"
                    onclick="return confirm('Are you sure you want to delete this product?');">Delete A Product</button>
            <table class="table table-bordered table-striped mt-3">
                <thead>
                <tr>
                    <th>Select</th>
                    <th>Product ID</th>
                    <th>Category ID</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>List Price</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><input type='radio' name='productID' value='<?= $product->getProductID(); ?>'></td>
                        <td><?= $product->getProductID(); ?></td>
                        <td><?= $product->getCategoryID(); ?></td>
                        <td><?= $product->getProductCode(); ?></td>
                        <td><?= $product->getProductName(); ?></td>
                        <td><?= $product->getListPrice(); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
</body>
</html>



