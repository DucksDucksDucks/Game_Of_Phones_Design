<?php
  include_once 'dbConfig.php';

  class DataManager {
  	private $connString;  // connection string to db
	private $user;        // db user account name
	private $passWord;    // db user account password
	private $pdo;         // PDO object representing a connection to db
	
	function __construct() {
		$this->connString = 'mysql:host='.DBHOST.';dbname='.DBNAME;
		// add the port if specified
		if(DBPORT!='') {
			$this->conString = $connString.DBPORT;
		}
		$this->user=DBUSER;
		$this->passWord=DBPASSWRD;
	}
	
	// Create a connection to the database
	public function connect(){
		try {
			$this->pdo=new PDO($this->connString,$this->user, $this->passWord);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	// Disconnect from the database
	public function disconnect() {
		$this->pdo = null;
	}
	
	// Query the database using a select query.
      
	public function doQuery($query, $preparedStmt=false, $dataValues=NULL) {
		if(!$preparedStmt){
			$result = $this->pdo->query($query);
		}
		else {
			// dataValues must be non-null and properly completed or
			// the following code will error out
			$stmt = $this->pdo->prepare($query);
			$stmt->execute($dataValues);
			$result = $stmt->fetchAll();
		}
		return $result;
	}
	
	// Execute a non-query SQL statement.

	public function doNonQuery($query, $preparedStmt=false, $dataValues=NULL) {
		if(!$preparedStmt){
			$count = $this->pdo->exec($query);
		}
		else {
			// dataValues must be non-null and properly completed or
			// the following code will error out
			$stmt = $this->pdo->prepare($query);
			$stmt->execute($dataValues);
			$count = $stmt->rowCount();
		}
		return $count;
	}
  }
?>