<?php

namespace app\models;

use app\database\connection;
use app\database\contracts\createInterface;
use app\database\contracts\readInterface;

class FurnitureType extends connection implements readInterface, createInterface
{
    private $id, $hight, $width, $length, $SKU;

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
     * Get the value of hight
     */
    public function getHight()
    {
        return $this->hight;
    }

    /**
     * Set the value of hight
     *
     * @return  self
     */
    public function setHight($hight)
    {
        $this->hight = $hight;

        return $this;
    }

    /**
     * Get the value of width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @return  self
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of length
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */
    public function setLength($length)
    {
        $this->length = $length;

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
        `furniture_type`.`id`,
        `furniture_type`.`hight`,
        `furniture_type`.`width`,
        `furniture_type`.`length`
    FROM 
        `product`
    JOIN 
        `furniture_type`
    ON
        `product`.`SKU` = `furniture_type`.`SKU`
";

        return $this->runDQL($query);
    }

    public function create()
    {
        $query = "INSERT INTO `furniture_type` (`hight`, `width`, `length`, `SKU`)
        VALUES ('{$this->hight}', '{$this->width}', '{$this->length}', '{$this->SKU}')";

        return $this->runDML($query);
    }
}
