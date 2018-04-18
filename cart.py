try:
	txt = open(r'log.txt', "wb")
	txt.write("is this working")
	txt.close()
except Exception,e:
	txt = open(r'log.txt', "wb")
	txt.write(e)
	txt.close()