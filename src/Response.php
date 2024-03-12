<?php
 
class Response
{
    public function __construct()
    {
        $this->outputHeaders();
 
        if (Request::method() == "OPTIONS") {
            exit();
        }
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