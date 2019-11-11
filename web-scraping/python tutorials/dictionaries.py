
###############################
######### Dictionaries ########
###############################
# created by {}
# e.g:
	# empty_list = {}
student = {
	'fname': 'Ali',
	'lname': 'Raza',
	'age': '24',
	'degree': 'BSIT',
	'coureses': ['Maths', 'CompSci', 'English']
}

print( student['age'] )

# if key does not exists
print( student.get('name', 'defautl value') )

# add/update multiple values
student.update({
	'name': 'AliRaxa',
	'phone': '+923-0403-37500'
	})

# print( student )

# delete a value
# del student['age']

# delete and get that value
age = student.pop('age')
# print( student )
print( age )

# get keys length
# print(len(student))

# get all keys/values or key/values pairs
# print(student.keys())
# print(student.values())
# print(student.items())

# loop through keys
for key in student:
	print(key)

# loop through key/value
for key, value in student.items():
	print(key, value)