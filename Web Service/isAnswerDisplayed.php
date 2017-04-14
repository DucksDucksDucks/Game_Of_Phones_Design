<?php

   include_once 'dataManager.php';

   $manager = new DataManager;

if($_SERVER['REQUEST_METHOD'] == "POST"){

// list fields
    
    $deviceID = $_POST['deviceID'];
    $questionID = $_POST['questionID'];
  
       if(!empty($deviceID)){
       //set up query
       	$query = 'select displayed from submittedanswers where p_device_id =' . $deviceID . ' and q_id = ' .$questionID .';';
           
		$manager->connect();
             
		$result = $manager->doQuery($query);
		
         if($result){
             // process the results placing them in an array
		$resultArray = array();
        while($row = $result->fetch()) {
            extract($row);
            $resultArray[] = array("displayed" => $displayed);
		} 
             // disconnect
		$manager->disconnect();
             
        $json = array("answer_info" => $resultArray);
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