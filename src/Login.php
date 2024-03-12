<?php
 
class Login extends Endpoint
{
    public function __construct()
    {
        switch(Request::method()) {
            case 'GET':
                $sql = "SELECT * FROM em_user";
                $dbConn = new Database("");
                $data = $dbConn->executeSQL($sql);
                break; 
            default; 
                throw new ClientError(405);
            }
                parent::__construct($data);
    }
}