<?php

    require_once 'Product.php';

    class ProductDAO {

        public function getConnection() {
            $address = "127.0.0.1";
            $userName = "cs2033user";
            $password = "cs2033pass";
            $database = "prodDB";
            $mysqli = new mysqli($address, $userName, $password, $database);
            if ($mysqli->connect_errno) {
                $mysqli = null;
            }
            return $mysqli;
        }

        public function addProduct($product) {
            $connection = $this->getConnection();
            $stmt = $connection->prepare("INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss",$product->getCategoryID(),$product->getProductCode(), $product->getProductName(), $product->getListPrice());
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }

        public function updateProduct($product) {
            $connection = $this->getConnection();
            $stmt = $connection->prepare("UPDATE products SET categoryID = ?, productCode = ?, productName = ?, listPrice = ? WHERE productID = ?");
            $stmt->bind_param("isssi", $product->getCategoryID(),$product->getProductCode(), $product->getProductName(), $product->getListPrice(), $product->getProductID());
            if($stmt->execute()){
                echo "Product updated successfully";
            }else{
                "Error updating product: ". $stmt->error;
            }

            $stmt->close();
            $connection->close();
        }

        public function deleteProduct($productID) {
            $connection = $this->getConnection();
            $stmt = $connection->prepare("DELETE FROM products WHERE productID = ?");
            $stmt->bind_param("i", $productID);
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }

        public function getProducts() {
            $connection = $this->getConnection();
            $stmt = $connection->prepare("SELECT * FROM products");
            $stmt->execute();
            $result = $stmt->get_result();

            $products = array();
            while ($row = $result->fetch_assoc()) {
                $product = new Product();
                $product->load($row);
                $products[] = $product;
            }

            $stmt->close();
            $connection->close();
            return $products;
        }

        public function getProductByID($productID) {
            $connection = $this->getConnection();
            $stmt = $connection->prepare("SELECT * FROM products WHERE productID = ?");
            $stmt->bind_param("i", $productID);
            $stmt->execute();
            $result = $stmt->get_result();

            $product = null;
            if ($row = $result->fetch_assoc()) {
                $product = new Product();
                $product->load($row);
            }

            $stmt->close();
            $connection->close();
            return $product;
        }
    }
?>
