<?php
 
class Response
{
 
    public function __construct()
    {
        $this->outputHeaders();
    }
    
    private function outputHeaders()
    {
        header('Content-Type: application/json');
    }
 
    public function outputJSON($data)
    {
        echo json_encode($data);
    }
 
}