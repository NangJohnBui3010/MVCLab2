<?php
   
    ini_set("display_errors", "On");

    class ProductList implements ProductAction {

        function processGET() {
            $productDAO = new ProductDAO();
            $products = $productDAO->getProducts();
            include "views/listProducts.php";
        }

        function processPOST() {
            return;
        }
    }

    class ProductAdd implements ProductAction {
        function processGET() {
            header('location: views/addProduct.php');
        }

        function processPOST() {

            ob_start();

            $categoryID = $_POST['categoryID'];
            $productCode = $_POST['productCode'];
            $productName = $_POST['productName'];
            $listPrice = $_POST['listPrice'];

            $product = new Product();
            $product->setCategoryID($categoryID);
            $product->setProductCode($productCode);
            $product->setProductName($productName);
            $product->setListPrice($listPrice);

            $productDAO = new ProductDAO();
            $productDAO->addProduct($product);
            
            
            header('Location: views/listProducts.php');
            ob_end_clean();
            exit;
        }
    }

    class ProductUpdate implements ProductAction {
        function processGET() {
            $productID = $_GET['productID'];
            $productDAO = new ProductDAO();
            $product = $productDAO->getProductByID($productID);
            include "views/updateProduct.php";
        }

        function processPOST() {

            ob_start();

            $productID = $_POST['productID'];
            $categoryID = $_POST['categoryID'];
            $productCode = $_POST['productCode'];
            $productName = $_POST['productName'];
            $listPrice = $_POST['listPrice'];

            $productDAO = new ProductDAO();
            $product = $productDAO->getProductByID($productID);
            $product->setCategoryID($categoryID);
            $product->setProductCode($productCode);
            $product->setProductName($productName);
            $product->setListPrice($listPrice);

            $productDAO->updateProduct($product);
            
            header("Location: views/listProducts.php");
            ob_end_clean();
            exit;
        }
    }

    class ProductDelete implements ProductAction {

        function processGET() {
            $productID = $_GET['productID'];
            $productDAO = new ProductDAO();
            $product = $productDAO->getProductByID($productID);
            include "views/deleteProduct.php";
        }

        function processPOST() {
            ob_start();
            $productID = $_POST['productID'];
            $submit = $_POST['submit'];
            
            if ($submit == 'CONFIRM') {
                $productDAO = new ProductDAO();
                $productDAO->deleteProduct($productID);
            }

            header("Location: views/listProducts.php");
            ob_end_clean();
            exit;
        }
    }
?>
