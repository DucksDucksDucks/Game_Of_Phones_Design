<?php

   include_once 'dataManager.php';

    $manager = new DataManager;
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    
    $deviceID = $_POST['deviceID'];
    $questionID = $_POST['questionID'];
  
        // set up a prepared statement to modify database
        
        $query = "UPDATE currentquestion
            SET q_id=?
            WHERE m_device_id = ?;";
        // $query .= "values(?,?,?,?,?);";
        $values = array($questionID, $deviceID);
		
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