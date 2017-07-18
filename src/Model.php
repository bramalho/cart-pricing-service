<?php
/**
 * Created by PhpStorm.
 * User: brunoramalho-olx
 * Date: 21/03/2017
 * Time: 15:18
 */

namespace CarPricingService;


class Model
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}