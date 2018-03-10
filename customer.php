<?php
include_once "config.php"; 
//$rights = $myPage->getPageAuthorizations();
$username = $_POST["name"];
$password = $_POST["email"];
$method = $_POST["method"];


try
  {
  



if($username && $password){
//echo "this is here" . $username;

 // echo "this is true"+$username+$password; 
  $person = login($username, $password); 

  if($method= "change"){
    changeCustomer(); 
  }
  createAdminPage($person['personId'], $person['employee']);
  
}
else{
  header( 'Location: http://192.168.50.56' ) ;
}
} catch(exception $e) {echo $e->getMessage();}


/*
function sksort(&$array, $subkey="id", $sort_ascending=false) {

    if (count($array))
        $temp_array[key($array)] = array_shift($array);

    foreach($array as $key => $val){
        $offset = 0;
        $found = false;
        foreach($temp_array as $tmp_key => $tmp_val)
        {
            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
            {
                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                                            array($key => $val),
                                            array_slice($temp_array,$offset)
                                          );
                $found = true;
            }
            $offset++;
        }
        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
    }

    if ($sort_ascending) $array = array_reverse($temp_array);

    else $array = $temp_array;
}



*/
?>
