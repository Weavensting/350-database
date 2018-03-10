<?php
include_once "config.php"; 
//$rights = $myPage->getPageAuthorizations();
$username = $_POST["username"];
$password = $_POST["password"];
$method = $_POST["method"];
$name = $_POST["name"];
$description = $_POST["description"];
$sale = $_POST["sale"];
$price = $_POST["price"];
$quantity = $_POST["quantity"];
$id = $_POST["id"];


try
  {



if($username && $password && $method&& $name&& $description&& $sale&& $price&& $quantity){
//echo "this is here" . $username;

 // echo "this is true"+$username+$password; 
  $person = login($username, $password); 
  if($method== "change"){
   
   changeProduct($id, $quantity, $price, $description, $name, $sale); 
   $table = createProductTable(); 
  echo $table ;
  }
  else{
  addProduct( $quantity, $price, $description,  $name, $sale); 
  $table = createProductTable();
  echo $table ; 
  }
  
}
else{
  header( 'Location: http://192.168.50.56/' ) ;
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
