<?php

   include_once 'dataManager.php';

    $manager = new DataManager;
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $deviceID = $_POST['deviceID'];
  
        // set up a prepared statement to modify database
        
        $query = "update submittedanswers set displayed = 1 where p_device_id = ?;";
        // $query .= "values(?,?,?,?,?);";
        $values = array($deviceID);
		
	    // connect to the database and execute the query.	
		$manager->connect();
		$result = $manager->doNonQuery($query,TRUE,$values);
		
		// disconnect
		$manager->disconnect();
		
         if($result){
        $json = array("status" => 1, "msg" => "Action completed");
            }
         else{
        $json = array("status" => 0, "msg" => "Error");
            }
	}
       
       else{ // method not POST
        $json = array("status" => 0, "msg" => "Request method not accepted");
        }
    
    /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
    
    ?>