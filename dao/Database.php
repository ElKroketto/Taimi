<?php

// Description on: http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/

include_once('DB_config.php');

class Database {

	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;

	private $dbh;
	private $error;

	private $stmt;

	public function __construct(){
 
 		// Set database connection string
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;		
		// Set options
		$options = array(
		    PDO::ATTR_PERSISTENT => true, 						// activate persistent connections
		    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,		// errors will lead to exceptions
		    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"	// use utf8 encoding for inserts, selects, updates
		);

		try {
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}

	public function bind($param, $value, $type = null){
 		// param: placeholder in query-string
 		// value: value of placeholder
 		// datatype of parameter

 		if (is_null($type)) {
		  switch (true) {
		    case is_int($value):
		      $type = PDO::PARAM_INT;
		      break;
		    case is_bool($value):
		      $type = PDO::PARAM_BOOL;
		      break;
		    case is_null($value):
		      $type = PDO::PARAM_NULL;
		      break;
		    default:
		      $type = PDO::PARAM_STR;
		  }
		}


		$this->stmt->bindValue($param, $value, $type);
	}	

	public function execute(){
	    return $this->stmt->execute();
	}


	public function resultset(){
	    $this->execute();
	    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function single(){
	    $this->execute();
	    return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}


	public function rowCount(){
	    return $this->stmt->rowCount();
	}

	public function lastInsertId(){
	    return $this->dbh->lastInsertId();
	}

// TRANSACTION MANAGEMENT
	public function beginTransaction(){
	    return $this->dbh->beginTransaction();
	}

	public function endTransaction(){
	    return $this->dbh->commit();
	}

	public function cancelTransaction(){
	    return $this->dbh->rollBack();
	}

// DEBUGGING
	public function debugDumpParams(){
	    return $this->stmt->debugDumpParams();
	}


}

?>