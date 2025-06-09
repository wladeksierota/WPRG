<?php

class Product{
    private $name;
    private $price;
    private $quantity;

    public function __construct($name, $price, $quantity) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getName() {
        return $this->name;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function __toString() {
        return "product:" . $this->name . ", price:" . $this->price . ", quantity:" . $this->quantity;
    }
}

Class Cart{
    private $products = [];

    public function __construct() {
        $this->products = [];
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function removeProduct(Product $productToRemove) {
        $this->products = array_filter($this->products,
            function($product) use ($productToRemove) {
                return $product !== $productToRemove;
            });
    }

    public function getTotal(){
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice() * $product->getQuantity();
        }
        return $total;
    }

    public function __toString() {
        $output = "Products in cart:\n";
        foreach ($this->products as $product) {
            $output .= $product . "\n";
        }
        $output .= "Total price: " . $this->getTotal();
        return $output;
    }
}