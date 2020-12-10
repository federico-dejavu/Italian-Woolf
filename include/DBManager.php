<?php
class DBManager{
    
    function DBConnection(){
		
		if (!defined('WOOLF_DB_SERVER')) {
			
			echo "Sorry, the website is experiencing problems. ERROR: NO DB CONNECTION";
			
		} else {
        
	        // Create connection
	        $conn = new mysqli(WOOLF_DB_SERVER, WOOLF_DB_USER, WOOLF_DB_PASSWORD, WOOLF_DB_NAME);

			// Change character set to utf8
			$conn -> set_charset("utf8");

			// Check connection
	        if ($conn->connect_error) {
	          die("Connection failed: " . $conn->connect_error);
	        } 
	        return $conn;

	    }

    }

    public function query($sql = "" )
    {
	    $mysqli = $this->DBConnection();
		if (!$result = $mysqli->query($sql)) {
		    echo "Sorry, the website is experiencing problems.";
		    echo "Error: Our query failed to execute and here is why: \n";
		    echo "Query: " . $sql . "\n";
		    echo "Errno: " . $mysqli->errno . "\n";
		    echo "Error: " . $mysqli->error . "\n";
		    exit;
		}
		/*
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
	    }
		
		return $data;
		*/
		$row = $result->fetch_assoc();
		$result->free();
		$mysqli->close();
		return $row;


		
    }
    
    
    public function queryList($sql = "" )
    {
	    $mysqli = $this->DBConnection();
		if (!$result = $mysqli->query($sql)) {
		    echo "Sorry, the website is experiencing problems.";
		    echo "Error: Our query failed to execute and here is why: \n";
		    echo "Query: " . $sql . "\n";
		    echo "Errno: " . $mysqli->errno . "\n";
		    echo "Error: " . $mysqli->error . "\n";
		    exit;
		}
		$data = array();
		while ($row = $result->fetch_row()) {
			$data[] = $row[0];
	    }
		
		return $data;

		$result->free();
		$mysqli->close();
    }
}
?>