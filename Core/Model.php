<?php
    class Model
    {

private static $db = null;
private static $production_db;


//connect to the correct database
    public static function getBdd($file = null) {
    	require(ROOT . 'Config/db.php');
    	$conn = $connections[$production_db];
    	self::$production_db = $production_db;

    	if($production_db == "mysql"){
	        if(is_null(self::$db)) {
	            self::$db = new PDO("mysql:host=".$conn['host'].";dbname=".$conn['database'], $conn['username'], $conn['password']);
	        }
	    } elseif($production_db == "csv"){
	    	require(ROOT . 'Config/Csv.php');
	    	self::$db = new Csv($file);
	    }

        return self::$db;
    }

    public function findOne($table, $id){
    	$result = array();
    	//get the database connection
        $req = self::getBdd($table);
        if(self::$production_db == "mysql"){
        	$sql = "SELECT * FROM $table WHERE id =" . $id;
        	$req = $req->prepare($sql);
        	$req->execute();
        	$result = $req->fetch();
        } elseif (self::$production_db == "csv") {
        	$result = self::$db->getOne($id);
        }

        return $result;
    }

//get all from table
    public function all($table){
    	$result = array();
    	//get the database connection
        $req = self::getBdd($table);
        if(self::$production_db == "mysql"){
        	$sql = "SELECT * FROM $table ";
        	$req = $req->prepare($sql);
        	$req->execute();
        	$result = $req->fetch();
        } elseif (self::$production_db == "csv") {
        	$result = self::$db->getall();
        }

        return $result;
    }

    }
?>