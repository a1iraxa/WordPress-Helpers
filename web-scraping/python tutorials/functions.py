def greeting(hello, name='Python'):
	return f'{hello}, {name}'

print(greeting('Hello', 'New'))

def student_info(*args, **kwargs):
	print(args)
	print(kwargs)

courses = ['Maths', 'CompSci']
info = {'name': 'New User', 'age': 24 }
student_info(courses, info)

student_info(*courses, **info)