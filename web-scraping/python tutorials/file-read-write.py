
import time

# # # # # # # # # 
# Writting file #
# # # # # # # # # 
with open('test.txt', 'r') as rf:
	with open('test-backup.txt', 'w') as wf:
		for line in rf:
			wf.write(line)
# # # # # # # # # # # # # # # #
# function to get file length #
# # # # # # # # # # # # # # # #
def __get_binary_file_len(fname):
    with open(fname,'rb') as f:
        for i, l in enumerate(f):
            pass
    return i + 1


# # # # # # # # # # # # # # #
# Wroking with binary files #
# # # # # # # # # # # # # # # 
file_name = 'C:/Users/Ali/Downloads/Images/2016-10-1556.JPG'
total = __get_binary_file_len(file_nmae)
current_line = 0

with open(file_nmae, 'rb') as rf:
	
	with open('new-dp.JPG', 'wb') as wf:
		for line in rf:
			wf.write(line)

			time.sleep(0.02)

			current_line +=1

			percentage = 100 * current_line / total

			print( 'Coping...', round(percentage, 1), '%')

		print('Copied !')


# # # # # # # # #  
# File reading  #  
# # # # # # # # # 
# with open('test.txt', 'r') as f:
# 	size_to_read = 10
# 	file_content = f.read(size_to_read)
# 	while len(file_content) > 0:
# 		print(file_content, end='\n ')
# 		f.seek(0) # set position to beginning
# 		file_content = f.read(size_to_read)