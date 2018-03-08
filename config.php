<?php
    define('DBUSER','root');
   define('DBPWD','6(z=n7em,W;uX,[p');
   define('DBHOST','192.168.50.56');
   define('DBNAME','secure');

public function login($username, $password)
  {
    $sql = "SELECT * FROM User WHERE userName=:username and password  = :password";
    $stmt = $this->conn->prepare_sql($sql);
    $stmt->bindValue(":password", $password);
    $stmt->bindValue(":username", $username);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    return $student;
  }
//Employee Functions
  public function getAllEmployees()
  {
    $sql = "SELECT * FROM Employee";
    $stmt = $this->conn->prepare_sql($sql);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    return $employee;
  }

  public function getEmployeeId($fname, $lname)
  {
    $sql = "SELECT eId FROM Employee WHERE fname=:fname and lname  = :lname";
    $stmt = $this->conn->prepare_sql($sql);
    $stmt->bindValue(":fname", $fname);
    $stmt->bindValue(":lname", $lname);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    return $employee;
  }

  public function changeEmployeeInformation($eID, $newFName, $newLName, $newPosition, $newAddress )
  {
    $sql = "UPDATE Employee SET fname = :newFName, lname = :newLName, position = :newPosition, address = :newAddress  WHERE eID=:eID";
    $stmt = $this->conn->prepare_sql($sql);
    $stmt->bindValue(":eID", $eID);
    $stmt->bindValue(":newFName", $newFName);
    $stmt->bindValue(":newLName", $newLName);
    $stmt->bindValue(":newPosition", $newPosition);
    $stmt->bindValue(":newAddress", $newAddress);
    $stmt->execute();
  }


  public function addEmployee($eID, $newFName, $newLName, $newPosition, $newAddress )
  {
    $sql = "INSERT INTO Employee (fname, lname, position, address) VALUES (:newFName, :newLName, :newPosition, :newAddress)";
    $stmt = $this->conn->prepare_sql($sql);
    $stmt->bindValue(":newFName", $newFName);
    $stmt->bindValue(":newLName", $newLName);
    $stmt->bindValue(":newPosition", $newPosition);
    $stmt->bindValue(":newAddress", $newAddress);
    $stmt->execute();
  }


  //Customer Functions
  public function getAllCustomers()
  {
    $sql = "SELECT * FROM Customer";
    $stmt = $this->conn->prepare_sql($sql);
    $stmt->execute();
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    return $customer;
  }

   public function changeCustomerInformation($customerID, $newFName, $newLName, $eServiceId, $newAddress )
  {
    $sql = "UPDATE Customer SET fname = :newFName, lname = :newLName, eServiceId = :eServiceId, address = :newAddress  WHERE customerID=:customerID";
    $stmt = $this->conn->prepare_sql($sql);
    $stmt->bindValue(":customerID", $customerID);
    $stmt->bindValue(":newFName", $newFName);
    $stmt->bindValue(":newLName", $newLName);
    $stmt->bindValue(":eServiceId", $eServiceId);
    $stmt->bindValue(":newAddress", $newAddress);
    $stmt->execute();
  }


	public function changeCustomerInformation($customerID, $newFName, $newLName, $eServiceId, $newAddress )
  {
    $sql = "INSERT INTO Customer (fname, lname, eServiceId, address) VALUES (:newFName, :newLName, :eServiceId, :newAddress)";
    $stmt = $this->conn->prepare_sql($sql);
    //$stmt->bindValue(":customerID", $customerID);
    $stmt->bindValue(":newFName", $newFName);
    $stmt->bindValue(":newLName", $newLName);
    $stmt->bindValue(":eServiceId", $eServiceId);
    $stmt->bindValue(":newAddress", $newAddress);
    $stmt->execute();
  }

  //Product Functions
  public function getAllProducts()
  {
    $sql = "SELECT * FROM Products";
    $stmt = $this->conn->prepare_sql($sql);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    return $product;
  }

   public function changeProductInformation($productID, $quantity, $price)
  {
    $sql = "UPDATE Products SET quantity = :quantity, price = :price  WHERE productID=:productID";
    $stmt = $this->conn->prepare_sql($sql);
    $stmt->bindValue(":productID", $productID);
    $stmt->bindValue(":quantity", $quantity);
    $stmt->bindValue(":price", $price);
    $stmt->execute();
  }

//html_entities

?>