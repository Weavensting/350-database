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
    return $student;
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
   function getAllEmployees()
  {
     $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Employee";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    return $employee;
  }

   function getEmployeeId($fname, $lname)
  {
    $sql = "SELECT eId FROM Employee WHERE fname=:fname and lname  = :lname";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":fname", $fname);
    $stmt->bindValue(":lname", $lname);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    return $employee;
  }

   function changeEmployeeInformation($eID, $newFName, $newLName, $newPosition, $newAddress )
  {
    $sql = "UPDATE Employee SET fname = :newFName, lname = :newLName, position = :newPosition, address = :newAddress  WHERE eID=:eID";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":eID", $eID);
    $stmt->bindValue(":newFName", $newFName);
    $stmt->bindValue(":newLName", $newLName);
    $stmt->bindValue(":newPosition", $newPosition);
    $stmt->bindValue(":newAddress", $newAddress);
    $stmt->execute();
  }


   function addEmployee($eID, $newFName, $newLName, $newPosition, $newAddress )
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
    $sql = "SELECT * FROM Customer";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    return $customer;
  }

    function changeCustomerInformation($customerID, $newFName, $newLName, $eServiceId, $newAddress )
  {
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
    $sql = "SELECT * FROM Products";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    return $product;
  }

    function changeProductInformation($productID, $quantity, $price)
  {
    $sql = "UPDATE Products SET quantity = :quantity, price = :price  WHERE productID=:productID";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":productID", $productID);
    $stmt->bindValue(":quantity", $quantity);
    $stmt->bindValue(":price", $price);
    $stmt->execute();
  }
}catch(exception $e) {echo $e->getMessage();}


//html_entities

?>