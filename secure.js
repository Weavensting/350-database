$(document).ready(function(){
	$(".wrapper").on('click', ".editButton", function(){
	  // Holds the product ID of the clicked element
	  console.log("this is being clicked");
	  $(this).closest("tr").next().show();
	});
	$(".cancel").click(function(){
	  // Holds the product ID of the clicked element
	  console.log("this is being clicked");
	  $(this).closest("tr").hide();
	});

	
	$(".wrapper").on('click', ".newEmployee", function(){
	  // Holds the product ID of the clicked element
	  $id=$(this).data();
	  console.log($id);
	  $id = $id.personid
	  $fname=$("#newEfname").val();
	  $lname=$("#newElname").val();
	  $position=$("#newEposition").val();
	  $address=$("#newEaddress").val();
	  $userinfo=$("#id").data(); 
	  $username=$userinfo.username; 
	  $password=$userinfo.password; 
	  $method= "new";
	  console.log($method);
	  $.ajax({  
	    type: "POST",  
	    url: "employee.php", 
	    data: {
	    	username: $username,
	    	password: $password,
	    	method: $method,
	    	fname: $fname,
	    	lname: $lname,
	    	position: $position,
	    	address:$address,
	    	personId: $id,
	    	
	    	
	    }	});;

	})



	$(".wrapper").on('click', ".changeEmployee", function(){
	  // Holds the product ID of the clicked element
	  $id=$(this).data();
	  console.log($id);
	  $id = $id.personid
	  $fname=$("#"+$id+"fname").val();
	  $lname=$("#"+$id+"lname").val();
	  $position=$("#"+$id+"position").val();
	  $address=$("#"+$id+"address").val();
	  $userinfo=$("#id").data(); 
	  $username=$userinfo.username; 
	  $password=$userinfo.password; 
	  console.log($username);
	  console.log($password);
	  console.log($address);

	  $method= "change";
	  console.log($method);
	  $.ajax({  
	    type: "POST",  
	    url: "employee.php", 
	    data: {
	    	username: $username,
	    	password: $password,
	    	method: $method,
	    	fname: $fname,
	    	lname: $lname,
	    	position: $position,
	    	address:$address,
	    	personId: $id,
	    	
	    	
	    },
	    success: function(data) {
  $("#employeeTable").html(data);
		}		});;

	});



	$(".wrapper").on('click', ".changeProduct", function(){
	  // Holds the product ID of the clicked element
	  $id=$(this).data();
	  console.log($id);
	  $id = $id.personid
	  $name=$("#"+$id+"name").val();
	  $quantity=$("#"+$id+"quantity").val();
	  $price=$("#"+$id+"price").val();
	  $sale=$("#"+$id+"sale").val();

	  $description=$("#"+$id+"description").val();
	  if($sale=="Yes"){
	  	$sale= 1 ; 
	  }
	  else{
	  	$sale=2;
	  }

	  $userinfo=$("#id").data(); 
	  $username=$userinfo.username; 
	  $password=$userinfo.password; 
	  

	  $method= "change";
	  console.log($method);
	  $.ajax({  
	    type: "POST",  
	    url: "product.php", 
	    data: {
	    	username: $username,
	    	password: $password,
	    	method: $method,
	    	name: $name,
	    	description: $description,
	    	sale: $sale,
	    	price: $price,
	    	quantity:$quantity,
	    	id: $id,
	    	
	    	
	    },
	    success: function(data) {
  $("#productTable").html(data);
		}		});;

	});



	$(".wrapper").on('click', ".addProduct", function(){
	  // Holds the product ID of the clicked element
	  $id=$(this).data();
	  console.log($id);
	  $id = $id.personid
	  $name=$("#nPname").val();
	  $quantity=$("#nPquantity").val();
	  $price=$("#nPprice").val();
	  $sale=$("#nPsale").val();

	  $description=$("#nPdescription").val();
	  if($sale=="Yes"){
	  	$sale= 1 ; 
	  }
	  else{
	  	$sale=2;
	  }

	  $userinfo=$("#id").data(); 
	  $username=$userinfo.username; 
	  $password=$userinfo.password; 
	  

	  $method= "add";
	  console.log($method);
	  $.ajax({  
	    type: "POST",  
	    url: "product.php", 
	    data: {
	    	username: $username,
	    	password: $password,
	    	method: $method,
	    	name: $name,
	    	description: $description,
	    	sale: $sale,
	    	price: $price,
	    	quantity:$quantity
	    	
	    	
	    },
	    success: function(data) {
  $("#productTable").html(data);
		}	});;

	});
});

