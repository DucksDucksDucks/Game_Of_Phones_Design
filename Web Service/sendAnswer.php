<?php

   include_once 'dataManager.php';

    $manager = new DataManager;
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $currentQID = $_POST['currentQID'];
    $deviceID = $_POST['deviceID'];
    $answer = $_POST['answer'];
        
        // set up a prepared statement to modify database
        
        $query = "INSERT INTO submittedanswers (q_id, p_device_id, sub_ans)";
        $query .= "values(?,?,?);";
        $values = array($currentQID, $deviceID, $answer);
		
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