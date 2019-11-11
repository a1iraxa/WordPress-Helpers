
# Return sum
def add(num1, num2):
	return num1 + num2


# Return sub
def sub(num1, num2):
	return num1 - num2

# Return multiplication
def multiply(num1, num2):
	return num1 * num2


# Return divion
def divide(num1, num2):
	try:
		return int(num1 / num2)
	except ZeroDivisionError as e:
		print("Dividing by zero error,", e)
		return 0
	

# Main function
def main():
	userContinue = True
	while userContinue:

		validInputs = False
		while not validInputs:
			try:
				# operations = ['+', '-', '*', '/', ]
				num1 = int(input("Enter number-1: "))
				num2 = int(input("Enter number-2: "))
				operation = int(input("What do you want to do? 1-Add, 2-Sub, 3-Multiply, 4-Divide: "))
				validInputs = True
			except Exception as e:
				print('Invalid input. Try again.', e)

		if ( operation == 1 ):
			print('Addding....\n')
			print( add(num1, num2) )

		elif( operation == 2 ):
			print('Subtracting....\n')
			print( sub(num1, num2) )

		elif( operation == 3 ):
			print('Multiplying....\n')
			print( multiply(num1, num2) )

		elif( operation == 4 ):
			print('Dividing....\n')
			print( divide(num1, num2) )
		user_YN = input('Would you like to start it again? Enter y for YES and n for NO: ')
		if (user_YN != 'y' ):
			userContinue = False
			break
		else:
			continue


if __name__ == "__main__":
	main()