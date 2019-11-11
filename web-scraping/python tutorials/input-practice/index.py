
# var = 4
multipliers = [1,2,3,4,5,6,7,8,9,10]
validInputs = False
while not validInputs:
	try:
		var = int(input( "int number:" ))
		validInputs = True
	except Exception as e:
		print('Invalid input. Try again.', e)
	else:
		print("Table of {var}")
		for m in multipliers:
			print( f' {var} * {m} = {var * m}',  )
