
try:
	file = open('test.txt', 'r')

except FileNotFoundError as e:
	print(e)
except SyntaxError as e:
	print(e)
except Exception as e:
	print(e)
else:
	print(file.read())
	file.close()
finally:
	print( "Executing finally" )