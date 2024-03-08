<?php
 
class Events extends Endpoint
{
    public function __construct()
    {
        $sql = "SELECT * FROM ";
        $dbConn = new Database("");
        $data = $dbConn->executeSQL($sql);
        parent::__construct($data);
    }
}