<?php

namespace app\models;

use app\database\connection;
use app\database\contracts\createInterface;
use app\database\contracts\readInterface;

class BookType extends connection implements readInterface, createInterface
{
    private $id, $weight, $SKU;


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
     * Get the value of weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     *
     * @return  self
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

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


    public function read()
    {
        $query = "SELECT 
        `product`.`SKU`,
        `product`.`name`,
        `product`.`price`,
        `product`.`type_id`,
        `book_type`.`id`,
        `book_type`.`weight`
    FROM 
        `product`
    JOIN 
        `book_type`
    ON
        `product`.`SKU` = `book_type`.`SKU`
";

        return $this->runDQL($query);
    }

    public function create()
    {
        $query = "INSERT INTO `book_type` (`weight`, `SKU`)
        VALUES ('{$this->weight}', '{$this->SKU}')";

        return $this->runDML($query);
    }
}
