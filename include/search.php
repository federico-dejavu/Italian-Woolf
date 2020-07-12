<?php
class search{
    
    function DBConnection(){
		
		if (!defined('WOOLF_DB_SERVER')) {
			
			echo "Sorry, the website is experiencing problems. ERROR: NO DB CONNECTION";
			
		} else {
        
	        // Create connection
	        $conn = new mysqli(WOOLF_DB_SERVER, WOOLF_DB_USER, WOOLF_DB_PASSWORD, WOOLF_DB_NAME);
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
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
	    }
		
		return $data;

		$result->free();
		$mysqli->close();
		
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
    
    public function clearKeywords($keywords = "" )
    {
        //$keywords="romanzi; racconti";
        //var_dump($keywords);
        if($keywords != ""){
            $keywords = str_replace(' ', ',', $keywords);
            $keywords = str_replace(';', ',', $keywords);
            $keywords = str_replace(',,', ',', $keywords);
            
            $arrKeywords = explode(",", $keywords);
            //$sqlK = $this->daArrayASQLid($arrKeywords);
            $sqlK = $this->daArrayASQLRegExp($arrKeywords);
            $keywords = $sqlK;
        }
        return $keywords;
    }

    public function daArrayASQLid($arr){
	    $tmp = ''; 
        foreach ($arr as $key) {
        	$tmp =$tmp."'$key',";
        }
        $arr = null;
        return $listID =  substr($tmp, 0, -1); 
    }

    public function daArrayASQLRegExp($arr){
	    $tmp = ''; 
        foreach ($arr as $key) {
        	$tmp = $tmp."$key|";
        }
        $arr = null;
        return $listID =  substr($tmp, 0, -1); 
    }



    public function simpleSearchWorks($works ="", $articles="", $keywords = "") {
        $arrWorks = array();
        $arrArticles = array();
        $arrTotal = array();
        
        $wksID = "";
        //var_dump($keywords);
        /* Estraggo i works_id con queste KW */
        if($keywords){
            $queryK = "SELECT WK.works_id FROM works_keywords as WK, keywords as K  where K.id = WK.keywords_id and K.keyword REGEXP '$keywords' ";
            $arrWorksID = $this->queryList($queryK);
            //var_dump($arrWorksID);
            $wksID = $this->daArrayASQLid($arrWorksID);
            //var_dump($wksID);
        }
        if($works == 'on'){
            /* Estraggo i works con queste KW */
            
            if($wksID){
                /* Recupero dati works */
            	$queryW = "SELECT  W.id as id, E.id as publisher_id, S.id as serie_id, 'work' as 'type', W.title, L.language, year, E.publisher, city, S.serie, W.pages, W.description, W.isbn, W.libraries, W.image ";
            	$queryW = $queryW."FROM works as W left join publishers as E ON W.publisher_id = E.id LEFT JOIN series as S ON W.serie_id = S.id INNER JOIN languages as L ON W.original = L.id ";
            	$queryW = $queryW."where W.id in($wksID) ";
            	//var_dump($queryW);
            	$arrWorks = $this->query($queryW);
            }
            
            
            
            
        }
        
        if($articles == 'on'){
            /* Estraggo i works con queste KW */
            
            if($wksID){
                /* Recupero dati works */
            	//$queryW = "SELECT W.id as work_id,E.id as publisher_id, S.id as serie_id, W.title, L.language, year, E.publisher, city, S.serie, W.pages, W.description, W.isbn, W.libraries, W.image ";
            	$queryA = "SELECT A.id as article_id, E.id as publisher_id, S.id as serie_id, 'article' as 'type', A.title, A.volume_title, A.journal_title, A.journal_issue, A.pubblication_date, A.year, E.publisher, A.city, S.serie, A.pages, A.price, T.typology, L.language, A.open_access, A.abstract, A.description, A.isbn, A.issn, A.libraries, A.image, A.doi ";
            	$queryA = $queryA."FROM articles as A left join publishers as E ON A.publisher_id = E.id LEFT JOIN series as S ON A.serie_id = S.id LEFT JOIN typologies as T ON A.typology_id=T.id INNER JOIN languages as L ON A.language = L.id ";
            	$queryA = $queryA."where A.id in($wksID) ";
            	//var_dump($queryA);
            	$arrArticles = $this->query($queryA);
            }
        }
        
        $arrTotal = array_merge($arrWorks,$arrArticles);
        return $arrTotal;
    }
    
     public function getEditions($id){
        /* Recupero illustrator */
        $arr = array();
        if($id){
            /* Estraggo edizioni */
            $queryE = "SELECT ED.id as edition_id, ED.title, ED.works_id, L.language, ED.year, E.publisher, ED.city, S.serie, ED.pages, ED.price, ED.description, ED.isbn, ED.libraries, ED.image ";
            $queryE = $queryE."FROM editions as ED left join publishers as E ON ED.publisher_id = E.id LEFT JOIN series as S ON ED.serie_id = S.id LEFT JOIN languages as L ON ED.original = L.id ";
            $queryE = $queryE."WHERE works_id = $id";
            $arr = $this->query($queryE);
            //var_dump($queryE);
        }
        return $arr;
    }   
    
    public function getElementsListWorks($id, $table){
        /* Recupero illustrator */
        $arr = array();
        if($id && $table){
            $queryP = "SELECT peoples_id FROM $table WHERE works_id in($id)";
            $arr = $this->queryList($queryP);
        }
        return $arr;
    }
    
    
    public function getElementsListEditions($id, $table){
        /* Recupero illustrator */
        $arr = array();
        if($id && $table){
            $queryP = "SELECT peoples_id FROM $table WHERE editions_id in($id)";
            $arr = $this->queryList($queryP);
        }
        return $arr;
    }    
    
    
    public function getElementsListArticles($id, $table){
        /* Recupero illustrator */
        $arr = array();
        if($id && $table){
            $queryP = "SELECT peoples_id FROM $table WHERE articles_id in($id)";
            $arr = $this->queryList($queryP);
        }
        return $arr;
    }
    
    
    public function getPeople($id){
        $arrPeople = array();
        if($id){
            $queryP = "SELECT id, other_name, fullname, birth_date, death_date, authority_record, image FROM peoples WHERE id in($id)";
            $arrPeople = $this->query($queryP);
        } 
        return $arrPeople;
    }


    public function getAllKeywords(){
        $queryK = "SELECT distinct(keyword) FROM keywords";
        $listK = $this->queryList($queryK);
        return $listK;
    }


    public function simpleSearchArticles($articles ="") {
        
        if($articles){
    
            /* Estraggo i works_id con queste KW */
            if($sqlK){
            	$queryK = "SELECT WK.works_id FROM works_keywords as WK, keywords as K  where K.id = WK.keywords_id and K.keyword in($sqlK) ";
                
                $result = $conn->query($queryK);
                
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_row()) {
                    $arrWorks[] =$row["works_id"];
                  }
                } else {
                  echo "0 results";
                } 
                $wksID = daAssocyASQLid($arrWorks);
            }
        
            /* Estraggo i works con queste KW */
            
            
        	$queryW = "SELECT id, title, original, year, publisher_id, city, serie_id, pages, description, isbn, libraries, image FROM works as W  where id in($wksID) ";
        	
        	$result = $conn->query($queryW);
                
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    //$arrWorks[] =$row["works_id"];
                    var_dump($row);
                }
            } else {
                  echo "0 results";
            } 
        	var_dump($queryW);
        }
        

        
    }

}
?>