<?php


class cleaner{

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




}

?>