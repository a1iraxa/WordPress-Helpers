import os

print(os.getcwd())

# for path, folders, files in os.walk('D:/DigitSol'):
# 	print('Path: ', path)
# 	print('Folders: ', folders)
# 	print('Files: ', files)

# print(os.environ.get('Path'))

print(dir(os.path)) # check available methods
print(os.path.basename('/tem/test.txt')) #get file name only
print(os.path.dirname('/tem/test.txt')) #get dir name only
print(os.path.split('/tem/test.txt')) #get both
print(os.path.splitext('/tem/test.txt')) #get file name and extension
print(os.path.exists('/tem/test.txt')) #check if file or path exists
print(os.path.isfile('/tem/test.txt')) #check if id file
print(os.path.isdir('D:/DigitSol')) #check if id file
