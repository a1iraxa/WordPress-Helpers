
#######################
######### List ########
#######################
# created by []
# e.g:
	# empty_list = [],
	# empty_list = list()
# courses_list = ['Maths', 'History', 'ComSci']
courses = ['Maths', 'History', 'ComSci']
courses_2 = ['Arts', 'English', 'CSS']

# Add at last
courses.append('Arts')

# Add in the begging
courses.insert(0, 'Java')

# Add multiple values from other list as values not whole list
# courses.extend(courses_2) 

# Remove a value
# courses.remove('Maths')

# Remove and get a last value as pop return value
poped = courses.pop()
# print( poped )

# Reverse list
# courses.reverse();

# sort actual list by passing acsending desending True/False
courses.sort(reverse=True)

# get sorted list into new variable and remain actual same by passing acsending desending True/False
sored_courses = sorted(courses)

# get value index
# print(courses.index('History'))

# get value index if value not exists
# Or to check if value is in list
# Return True/False
# print( 'Physics' in courses )

# join list into strng
# list to string
# courses_str = ' - '.join(courses)
# print(courses_str)

# splite string to list
# string to list
# courses_str = courses_str.split(' - ')
# print(courses_str)

# loop through key,value
# for key,value in enumerate(courses, start=1):
	# print(key, value)


# print( courses )

#########################
######### Tuples ########
#########################
# tuple are not changable or we can say immutable unlike list
# created by ()
# e.g:
	# empty_tuple = (),
	# empty_tuple = tuple()
# courses_tuples = ('Maths', 'History', 'ComSci')

#######################
######### Sets ########
#######################
# tuple are not changable or we can say immutable unlike list
# created by {}
# e.g:
	# empty_sets = set()
# courses_sets = {'Maths', 'History', 'ComSci', 'ComSci'}
# It throughs out the duplications
# It does not care about order, It changes order every time
# It detect value either exists or not but more optimized

courses_sets = {'Maths', 'History', 'ComSci', 'ComSci'}
courses_sets_2 = {'Maths', 'History', 'English', 'Bio'}
# print(courses_sets)

# detect value either exists or not but more optimized
# print( 'Maths' in courses_sets)

# get same values
# print(courses_sets.intersection(courses_sets_2))

# get difference
# print(courses_sets.difference(courses_sets_2))

# get combined
print(courses_sets.union(courses_sets_2))
