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
username = ""
password = ""
username = sys.argv[1]
password = sys.argv[2]
item = sys.argv[3]

def getProductInfo(newproductId):
	newproductId = int(newproductId)
	print "something"
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


def addItem(customerId, item):
	item = int(item)
	results =collection.update({"customerId":customerId, "carts.purchased":0 }, {'$push': {"carts.$.cart":{"itemId":item}} }, upsert=False)
	print results

if(username==""):
	redirectURL = "http://192.168.50.56"
	print('<html>')
	print('  <head>')
	print('    <meta http-equiv="refresh" content="0;url='+str(redirectURL)+'" />') 
	print('  </head>')
	print('</html>')
if(password==""):
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
		addItem(customerId, item)
	else:
		redirectURL = "http://192.168.50.56"
		print('<html>')
		print('  <head>')
		print('    <meta http-equiv="refresh" content="0;url='+str(redirectURL)+'" />') 
		print('  </head>')
		print('</html>')

	redirectURL = "http://192.168.50.56/host-cgi"
	print('<html>')
	print('  <head>')
	print('    <meta http-equiv="refresh" content="0;url='+str(redirectURL)+'" />') 
	print('  </head>')
	print('</html>')
	