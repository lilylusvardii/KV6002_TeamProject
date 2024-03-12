<?php
 
class SignUp extends Endpoint
{
    public function __construct()
    {
        switch(Request::method()) {
            case 'GET':
                $sql = "SELECT Name, username, password, phonenumber, location FROM em_signup";
                $dbConn = new Database("");
                $data = $dbConn->executeSQL($sql);
                break; 
            default;
                throw new ClientError(404); 
        }
                parent::__construct($data);
    }
}