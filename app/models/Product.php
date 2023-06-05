<?php

namespace app\models;

use app\database\connection;
use app\database\contracts\createInterface;
use app\database\contracts\deleteInterface;

class Product extends connection implements deleteInterface, createInterface{
    private $SKU, $name, $price, $type_id;

    /**
     * Get the value of SKU
     */ 
    public function getSKU()
    {
        return $this->SKU;
    }

    /**
     * Set the value of SKU
     *
     * @return  self
     */ 
    public function setSKU($SKU)
    {
        $this->SKU = $SKU;
        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get the value of type_id
     */ 
    public function getType_id()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     *
     * @return  self
     */ 
    public function setType_id($type_id)
    {
        $this->type_id = $type_id;
        return $this;
    }

    public function delete($deleteItems){
        $query = "DELETE FROM `product` WHERE `SKU`='{$deleteItems}'";
        return $this->runDML($query) . header("Refresh:0");
    }

    public function create(){
        $query = "INSERT INTO `product` (`SKU`, `name`, `price`, `type_id`)
        VALUES ('{$this->SKU}', '{$this->name}', '{$this->price}', '{$this->type_id}')";
        return $this->runDML($query);
    }

    public function getProductBySKU(){   //for unique
            $query = "SELECT * FROM `product` WHERE `SKU`='{$this->SKU}'";
            return $this->runDQL($query);
    }

}