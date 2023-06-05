<?php

namespace app\models;

use app\database\connection;
use app\database\contracts\readInterface;

class TypeOfProduct extends connection implements readInterface {
    private $id, $type;


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
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    
    public function read()
    {
        $query = "SELECT * FROM `type_of_product`";
        return $this->runDQL($query);
    }
}