<?php
 
class Endpoint 
{
    private $data;
 
    public function __construct($data = ["message" => []])
    {
        $this->setData($data);
    }
 
    public function setData($data)
    {
        $this->data = $data;
    }
 
    public function getData()
    {
        return $this->data;
    }
}
