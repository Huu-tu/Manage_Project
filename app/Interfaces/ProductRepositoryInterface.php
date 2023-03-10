<?php

namespace App\Interfaces;

interface ProductRepositoryInterface{
    public function getAllProducts();
//    public function getProductById($productId);
    public function createProduct(array $productDetails);
    public function deleteProduct($productId);
    public function updateProduct($productId, array $newDetails);
//    public function getFulfilledProducts();
}
