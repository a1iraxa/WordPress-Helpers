name = 'Find Index'
print( f'{name} Module Importing...' )
print( f'{name} Module Imported!' )

def find_index(data, search):
	for index, value in enumerate(data):
		
		if value == search:
			return index

	return -1
