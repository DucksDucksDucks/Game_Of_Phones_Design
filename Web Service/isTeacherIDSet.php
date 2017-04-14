<?php

   include_once 'dataManager.php';

   $manager = new DataManager;

if($_SERVER['REQUEST_METHOD'] == "POST"){

// list fields
    
    $deviceID = $_POST['deviceID'];
  
       if(!empty($deviceID)){
       //set up query
       	$query = 'select * from currentquestion where m_device_id =' . $deviceID .';';
        //$values = array($memberFirstName, $memberLastName);
           
		$manager->connect();
             
		$result = $manager->doQuery($query);
		
         if($result){
             // process the results placing them in an array
		$resultArray = array();
        while($row = $result->fetch()) {
            extract($row);
            $resultArray[] = array("m_device_id" => $m_device_id, "q_id" => $q_id);
		} 
             // disconnect
		$manager->disconnect();
             
        $json = array("question_info" => $resultArray);
            }
        else {$json = array("status" => 0, "msg" => "Not result");}
       }
       else{
           $json = array("status" => 0, "msg" => "Input not defined");
       }
}
       else{ // method not POST
        $json = array("status" => 0, "msg" => "Request method not accepted");
        }
    
    /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);
    
    ?>