<?php
    define('DBUSER','query');
   define('DBPWD','!5@m[~CcK\UVX5DFAD32');
   define('DBHOST','localhost');
   define('DBNAME','secure');

  
try{

   function login($username, $password)
  {
    $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT personId, employee FROM UserNames WHERE username=:username and password  = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if($student){
    	if($student['employee']!=1){
header( 'Location: http://192.168.50.56' ) ;
    	}
    	else{
    		return $student;
    	}
    	
    }

    else{
		header( 'Location: http://192.168.50.56' ) ;
    }

    
  }

  function getAccess($personId)
  {
    $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT positionId FROM Employee WHERE personId=:personId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":personId", $personId);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    return $student;
  }



  function getFirstName($personId, $employee){
    $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($employee==1){
    $sql = "SELECT fname FROM Employee WHERE personId=:personId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":personId", $personId);
    $stmt->execute();
    $name = $stmt->fetch(PDO::FETCH_ASSOC);
    return $name["fname"];
    }
    else{
    
    $sql = "SELECT fname FROM Customer WHERE personId=:personId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":personId", $personId);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    return $name["fname"];
    }
  }
//Employee Functions
  function getPosition($positionId){
    $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT name, wage FROM Position where positionId = :positionId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":positionId", $positionId);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    return $employee;
  }
  function getPositionbyName($positionName){
    $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT positionId FROM Position where name = :positionName";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":positionName", $positionName);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    return $employee;
  }
  function getAllPositions(){
  	 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT name FROM Position";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":positionId", $positionId);
    $stmt->execute();
    $employee = $stmt->fetchAll();
    return $employee;
  }
   function getAllEmployees()
  {
     $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Employee";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $employee = $stmt->fetchAll();
    return $employee;
  }





   function getEmployeeId($fname, $lname)
  { $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    getNextPersonId(); 
    getNextEmployeeId(); 
    $sql = "SELECT eId FROM Employee WHERE fname=:fname and lname  = :lname";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":fname", $fname);
    $stmt->bindValue(":lname", $lname);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    return $employee;
  }

   function changeEmployee($pID, $newFName, $newLName, $newPosition, $newAddress )
  {
  	 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE Employee SET fname = :newFName, lname = :newLName, positionId = :newPosition, address = :newAddress  WHERE personId=:pID";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":pID", $pID);
    $stmt->bindValue(":newFName", $newFName);
    $stmt->bindValue(":newLName", $newLName);
    $stmt->bindValue(":newPosition", $newPosition);
    $stmt->bindValue(":newAddress", $newAddress);
    $stmt->execute();
  }


   function addEmployee($newFName, $newLName, $newPosition, $newAddress )
  {

    $sql = "INSERT INTO Employee (fname, lname, position, address) VALUES (:newFName, :newLName, :newPosition, :newAddress)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":newFName", $newFName);
    $stmt->bindValue(":newLName", $newLName);
    $stmt->bindValue(":newPosition", $newPosition);
    $stmt->bindValue(":newAddress", $newAddress);
    $stmt->execute();
  }


  //Customer Functions
   function getAllCustomers()
  {
  	 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM Customer";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $customer = $stmt->fetchAll();
    return $customer;
  }

   function getReportCount($cId)
  { $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT COUNT(report) FROM Alarms WHERE customerId=:cId";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":cId", $cId);
    $stmt->execute();
    $count = $stmt->fetch();
    return $count[0];
  }

    function changeCustomerInformation($customerID, $newFName, $newLName, $eServiceId, $newAddress )
  {
  	 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE Customer SET fname = :newFName, lname = :newLName, eServiceId = :eServiceId, address = :newAddress  WHERE customerID=:customerID";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":customerID", $customerID);
    $stmt->bindValue(":newFName", $newFName);
    $stmt->bindValue(":newLName", $newLName);
    $stmt->bindValue(":eServiceId", $eServiceId);
    $stmt->bindValue(":newAddress", $newAddress);
    $stmt->execute();
  }


   

  //Product Functions
   function getAllProducts()
  {
  	 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Products";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $product = $stmt->fetchAll();
    return $product;
  }



    function changeProduct($productID, $quantity, $price, $description,  $name, $sale)
  {
  	 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE Products SET Name=:name, Description=:description, Price = :price, Quantity = :quantity, forSale = :sale  WHERE productID=:productID";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":productID", $productID);
    $stmt->bindValue(":quantity", $quantity);
    $stmt->bindValue(":price", $price);
    $stmt->bindValue(":description", $description);
    $stmt->bindValue(":name", $name);
    $stmt->bindValue(":sale", $sale);
    $stmt->execute();
  }


    function addProduct( $quantity, $price, $description,  $name, $sale)
  {
  	 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO Products (Name, Description, Price, Quantity, forSale) VALUES (:name, :description, :price, :quantity, :sale)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":quantity", $quantity);
    $stmt->bindValue(":price", $price);
    $stmt->bindValue(":description", $description);
    $stmt->bindValue(":name", $name);
    $stmt->bindValue(":sale", $sale);
    $stmt->execute();
  }


  function getAllAlarms()
  {
  	 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM Alarms";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $customer = $stmt->fetchAll();
    return $customer;
  }

  function getAllEmergency()
  {
  	 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM EmergencyServices";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $customer = $stmt->fetchAll();
    return $customer;
  }

  function createAdminPage($personId,  $employee, $username, $password){
  $firstname=getFirstName($personId, $employee); 
  print '<head><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><script src="secure.js"></script><link href="secure.css" rel="stylesheet" type="text/css"></head><div class="wrapper"><img id="logo" src="images/lock-logo1.png"><br><h1 class="gray header-select-left" id="reads">May-B Secure</h1><h1 class="black header-select-right" id="reads">Admin</h1><div class="gray sub-header">Welcome '.$firstname.'</div><br><div class="full-header">Employee</div><div id="id" data-username="'.$username.'" data-password="'.$password.'">';
    $employeeTable= createEmployeeTable(); 
    print $employeeTable; 
    print "<div class='full-header'>Customer</div>";
    $customerTable = createCustomerTable(); 
    print $customerTable; 
     print "<div class='full-header'>Products</div>";
    $productTable = createProductTable(); 
    print $productTable; 
    print "<div class='full-header'>Emergency Services</div>";
    $emergencyTable = createEmergencyTable(); 
    print $emergencyTable; 
    print "<div class='full-header'>Alarm Reports</div>";
    $reportTable = createReportTable(); 
    print $reportTable; 
    print "</div>"; 

}

function createEmployeeTable(){
  $allEmployee = getAllEmployees(); 

  $html="<div id='employeeTable'><table  class='full-table'><tr><th>Name</th><th>Position</th><th>Pay</th><th>Address</th><th></th></tr>"; 
  foreach ($allEmployee as $emp){
    
    $html=$html."<tr><td>".$emp['fname']." ".$emp['lname']."</td>"; 
    $position = getPosition($emp["positionId"]); 
    $html=$html."<td>".$position['name']."</td>";
    $html=$html."<td>".$position['wage']."</td>";
    $html=$html."<td>".$emp['address']."</td>";
    $html=$html."<td class='blue editButton'>Edit</td></tr>";

    $html=$html."<tr class='edit'><form><td><input id='".$emp["personId"]."fname' value=".htmlentities($emp['fname'], ENT_QUOTES)." type='text'><input id='".$emp["personId"]."lname' value=".htmlentities($emp['lname'], ENT_QUOTES)." type='text'></td>"; 
    $Allposition = getAllPositions(); 
    $html=$html."<td><select id='".$emp["personId"]."position'>";
    foreach($Allposition as $pos){
      $html=$html."<option>".htmlentities($pos["name"], ENT_QUOTES)."</option>";
    }
    $html=$html."</select></td>";
    $html=$html."<td></td>";
    $html=$html."<td><input id='".$emp["personId"]."address' value='".htmlentities($emp['address'], ENT_QUOTES)."' type='text'></td>";
    $html=$html."<td ><span class='red cancel'>Cancel</span><span>     </span><span data-personid='".$emp["personId"]."' class='blue changeEmployee'>Save</span></td></tr>";
  }
  $html=$html."</table><table class='full-table'>"; 

  $html=$html."<tr class='edit'><form><td><input id='newEfname'  type='text'><input id='newElname'  type='text'></td>"; 
    $Allposition = getAllPositions(); 
    $html=$html."<td><select id='newEposition'>";
    foreach($Allposition as $pos){
      $html=$html."<option>".htmlentities($pos["name"], ENT_QUOTES)."</option>";
    }
    $html=$html."</select></td>";
    $html=$html."<td><input id='newEaddress' type='text'></td>";
    $html=$html."<td ><span class='blue newEmployee'>Add</span></td></tr></table></div>";
  return $html;
}

function createCustomerTable(){
  $allCustomer = getAllCustomers(); 
  /*print "<pre>";
  print_r($allCustomer);
  print "</pre>";*/

  $html="<table class='full-table'><tr><th>Name</th><th>Reports</th><th>Phone</th><th>email</th><th>Address</th></tr>"; 
  foreach ($allCustomer as $customer){
    
    $html=$html."<tr><td>".$customer['fname']." ".$customer['lname']."</td>"; 
    $reports = getReportCount($customer["customerId"]); 
    $html=$html."<td>".$reports."</td>";
    $html=$html."<td>".$customer['phone']."</td>";
    $html=$html."<td>".$customer['email']."</td>";
    $html=$html."<td>".$customer['address']."</td></tr>";
  }
  $html=$html."</table>"; 
  return $html;
}

function createProductTable(){
  $allProducts = getAllProducts(); 
 
  $html="<div id='productTable'><table  class='full-table'><tr><th>Name</th><th>Quantity</th><th>Price</th><th>For Sale</th><th>Description</th></tr>"; 
  foreach ($allProducts as $prod){
    
    $html=$html."<tr><td>".htmlentities($prod['Name'], ENT_QUOTES)."</td>"; 
    //$position = getPosition($prod["positionId"]); 
    $html=$html."<td>".htmlentities($prod['Quantity'], ENT_QUOTES)."</td>";
    $html=$html."<td>".htmlentities($prod['Price'], ENT_QUOTES)."</td>";
    if($prod['forSale']==1){
       $html=$html."<td>Yes</td>";
    }
    else{
      $html=$html."<td>No</td>";
    }
    $html=$html."<td>".htmlentities($prod['Description'], ENT_QUOTES)."</td>";
    $html=$html."<td class='blue editButton'>Edit</td></tr>";

    $html=$html."<tr class='edit'><td><input id='".htmlentities($prod['productId'], ENT_QUOTES)."name' value=".htmlentities($prod['Name'], ENT_QUOTES)." type='text'></td>";  
    $html=$html."<td><input id='".htmlentities($prod['productId'], ENT_QUOTES)."quantity' type='number' value='".htmlentities($prod['Quantity'], ENT_QUOTES)."'>";
    $html=$html."</input></td>";
    $html=$html."<td><input id='".htmlentities($prod['productId'], ENT_QUOTES)."price' type='number' value='".htmlentities($prod['Price'], ENT_QUOTES)."'>";
    $html=$html."<td><select id='".htmlentities($prod['productId'], ENT_QUOTES)."sale' value='".htmlentities($emp['address'], ENT_QUOTES)."' ><option>Yes</option><option>No</option></td>";
    $html=$html."<td><input id='".htmlentities($prod['productId'], ENT_QUOTES)."description' type='text' value='".htmlentities($prod['Description'], ENT_QUOTES)."'>";
    $html=$html."<td ><span class='red cancel'>Cancel</span><span>     </span><span data-personid='".htmlentities($prod['productId'], ENT_QUOTES)."' class='blue changeProduct'>Save</span></td></tr>";
  }
  
  $html=$html."</table>"; 

$html=$html."<div class='full-header'>Add Product</div>";
   $html=$html."<table class='full-table'><tr><th>Name</th><th>Quantity</th><th>Price</th><th>For Sale</th><th>Description</th></tr>"; 

    $html=$html."<tr><td><input id='nPname' type='text'></td>";  
    $html=$html."<td><input id='nPquantity' type='number'>";
    $html=$html."</input></td>";
    $html=$html."<td><input id='nPprice' type='number' >";
    $html=$html."<td><select id='nPsale' ><option>Yes</option><option>No</option></td>";
    $html=$html."<td><input id='nPdescription' type='text' >";
    $html=$html."<td ><span class='blue addProduct'>Add</span></td></tr>";
  
  
  $html=$html."</table></div>"; 
  return $html;
}

function createAddProductTable(){

}

function createEmergencyTable(){
  $allEmployee = getAllEmergency(); 
 
  $html="<table class='full-table'><tr><th>Type</th><th>Area</th><th>Phone</th></tr>"; 
  foreach ($allEmployee as $emp){
    
    $html=$html."<tr><td>".$emp['type']."</td>"; 
    $html=$html."<td>".$emp['area']."</td>"; 
    $html=$html."<td>".$emp['phone']."</td></tr>";
  }
  $html=$html."</table>"; 
  return $html;
}

function createReportTable(){
  $allReport = getAllAlarms(); 
 
  $html="<table class='full-table'><tr><th>customerId</th><th>Owner Contacted</th><th>Services Contacted</th><th>Employee Id</th><th>Date/Time</th><th>Report</th></tr>"; 
  foreach ($allReport as $emp){
    
    $html=$html."<tr><td>".$emp['customerId']."</td>"; 
    $html=$html."<td>".$emp['ownerContacted']."</td>";
    $html=$html."<td>".$emp['servicesContacted']."</td>";
    $html=$html."<td>".$emp['employeeId']."</td>";
    $html=$html."<td>".$emp['dateTime']."</td>";
    $html=$html."<td>".$emp['report']."</td></tr>";
  }
  $html=$html."</table>"; 
  return $html;
}


}catch(exception $e) {echo $e->getMessage();}




//html_entities

?>