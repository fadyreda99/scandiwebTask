<?php

namespace app\models;

use app\database\connection;
use app\database\contracts\createInterface;
use app\database\contracts\readInterface;

class DVDType extends connection implements readInterface, createInterface{
    private $id, $size, $SKU;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of size
     */ 
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */ 
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

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


    public function read(){
        $query = "SELECT 
                    `product`.`SKU`,
                    `product`.`name`,
                    `product`.`price`,
                    `product`.`type_id`,
                    `dvd_disc_type`.`id`,
                    `dvd_disc_type`.`size`
                FROM 
                    `product`
                JOIN 
                    `dvd_disc_type`
                ON
                    `product`.`SKU` = `dvd_disc_type`.`SKU`
                ";
        return $this->runDQL($query);
        
    }

    public function create(){
        $query = "INSERT INTO `dvd_disc_type` (`size`, `SKU`)
        VALUES ('{$this->size}', '{$this->SKU}')";
        return $this->runDML($query);
    }

  
}