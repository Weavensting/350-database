#!/usr/bin/env python
import MySQLdb as mdb
import sys
import cgi
import cgitb; cgitb.enable()  # for troubleshooting
import json
from pymongo import MongoClient
from bson.json_util import dumps

#mongo db connection
client = MongoClient('localhost', 27017)
db = client.secure
collection = db.customer
#serialized_results = [json.dumps(result, default=json_util.default, separators=(',', ':')) for result in results]
username = " "
password = " "
username = sys.argv[1]
password = sys.argv[2]


def getProductInfo(newproductId):
	con = mdb.connect('localhost', 'query', 'LceBQqlBpGMFvsoi', 'secure');
	cur = con.cursor()
	sql = ('SELECT * FROM Products Where productId = %s''' % (newproductId))
	cur.execute(sql)
	results = cur.fetchone()
	con.close()
	return results


def getCustomerInfo(username, password):
	username = '"'+username+'"'; 
	password = '"'+password+'"'; 
	con = mdb.connect('localhost', 'query', 'LceBQqlBpGMFvsoi', 'secure');
	cur = con.cursor()
	#sql = ('SELECT personId FROM UserNames Where username = "cosmo" and password = "cosmo"')
	sql = ('SELECT personId FROM UserNames Where username = %s and password = %s''' % (username, password))
	cur.execute(sql)
	results = cur.fetchone()
	con.close()
	return results

def getCustomerId(personId):
	con = mdb.connect('localhost', 'query', 'LceBQqlBpGMFvsoi', 'secure');
	cur = con.cursor()
	sql = ('SELECT * FROM Customer Where personId = %s ''' % (personId))
	cur.execute(sql)
	results = cur.fetchone()
	con.close()
	return results
def getNewAccount(customerId, fname, lname, phone, email):

	customerInfo = {"customerInfo":{"fName":fname, "lName":lname,"address":{}}, "customerId": customerId, "carts":[{"cart": [], "totalCost":"0", "purchased": 0, "date":""}]}
	print customerInfo

	createdId = collection.insert_one(customerInfo)
	print createdId


def get(customerId):
    results =collection.find_one({"customerId":customerId})
    return dumps(results)


if(username==" "):
	redirectURL = "http://192.168.50.56"
	print('<html>')
	print('  <head>')
	print('    <meta http-equiv="refresh" content="0;url='+str(redirectURL)+'" />') 
	print('  </head>')
	print('</html>')

else:
	personId = getCustomerInfo(username, password)
	customerInfo = getCustomerId(personId[0])
	customerId =str(customerInfo[0])
	results = get(customerId); 
	ParsedValue = results[1]
	json_data = '{"a": 1, "b"": 2, "c": 3, "d": 4, "e": 5}'
	loaded_json = json.loads(results)
	if(loaded_json):
		lname =  loaded_json["customerInfo"]["lName"]
		fname = loaded_json["customerInfo"]["fName"]
		
	else:
		
		fname = customerInfo[1]
		lname = customerInfo[2]
		phone = customerInfo[7]
		email = customerId
		customerId = customerId[0]
		account = getNewAccount(customerId, fname, lname, phone, email) 
		results = get(customerId)
		ParsedValue = results[1]
		json_data = '{"a": 1, "b"": 2, "c": 3, "d": 4, "e": 5}'
		loaded_json = json.loads(results)

	

	print """
	<html>
	<head>
	  <link href="../secure.css" rel="stylesheet" type="text/css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	</head>
	  <body>
	    <div class="wrapper">
	      <img id="logo" src="../images/lock-logo1.png"><br>
	      <h1 class="gray header-select-left" id="reads">May-B Secure</h1>
	      <h1 class="black header-select-right" id="reads">Welcome """+fname+"""</h1>
	      <div class="gray sub-header">We can almost guarantee security</div>
	      <br>
	<div class="full-header">
	      Want to see your Cart and finish your purchase? 
	    </div>   
	    <form action="index.php" method="post">    
 		<input type="hidden" name="site" value="cart">
	  <input  class="add" type="submit" data-item="4" value="Go to Cart" >
	 </form>
	<div class="full-header">
	      Merchandise
	    </div>
	<div class="item"> 
	  <h2>Camera</h2>
	  <form action="index.php" method="post">
	  <img src="../itemImages/camera.jpg"> 
	  <input type="hidden" name="site" value="add">
	   <input type="hidden" name="item" value="3">
	  <input  class="add" type="submit" data-item="3" value="Add" >
	 </form>

	    </div>
	    <div class="item"> 
	  <h2>Door Bell</h2>
	  <form action="index.php" method="post">
	  <img src="../itemImages/door.jpg"> 
	  <input type="hidden" name="site" value="add">
	   <input type="hidden" name="item" value="4">
	  <input  class="add" type="submit" data-item="4" value="Add" >
	 </form>
	    </div>
	    <div class="item"> 
	  <h2>Motion Detector</h2>
	  <form action="index.php" method="post">
	  <img src="../itemImages/motion.png"> 
	  <input type="hidden" name="site" value="add">
	   <input type="hidden" name="item" value="2">
	   <input  class="add" type="submit" data-item="2" value="Add" >
	 </form>
	    </div>
	    <div class="item"> 
	  <h2>Panel</h2>
	  <form action="index.php" method="post">
	  <img src="../itemImages/panel.jpg"> 
	   <input type="hidden" name="site" value="add">
	   <input type="hidden" name="item" value="1">
	   <input onclick="add(this)" class="add" type="submit" data-item="1" value="Add" >
	 </form>
	    </div>
	  </body>
	</html>


	<script> 

		function add($this){

		$id = $($this).data();
		 console.log($id);
		$item = $id.item
					$.ajax({
			  url: "index.php",
			  method: "POST",
			  data: { site : "add", 
			  		  item : $item },
			  dataType: "html"
			});
		};



	</script> 
	"""

