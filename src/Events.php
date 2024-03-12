<?php
 
class Events extends Endpoint
{
    public function __construct()
    {
        switch(Request::method()) {
            case 'GET':
                $sql = "SELECT eventname, description, location, capacity, organiser FROM em_events";
                $dbConn = new Database("");
                $data = $dbConn->executeSQL($sql);
                break; 
            default; 
                throw new ClientError(405); 
            }
                parent::__construct($data);

    }
}