<?php

include_once 'dataManager.php';

class myDataManager extends DataManager {
    
    public function __construct(){
        parent::__construct();
    }
    public function connect(){
        parent::connect();
    }
    public function disconnect(){
        parent::disconnect();
    }
    public function doQuery($query,$preparedStmt=false, $dataValues=NULL){
        $result = parent::doQuery($query,$preparedStmt=false, $dataValues=NULL);
        return $result;
    }
    
    public function doNonQuery($query, $preparedStmt=false, $dataValues=NULL){
        $count = parent::doNonQuery($query, $preparedStmt=false, $dataValues=NULL);
        return $count;
    }
}

?>