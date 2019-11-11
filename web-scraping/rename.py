import glob
import os
import time

searchedfile = glob.glob("*.mp4")
files = sorted( searchedfile, key = lambda file: os.path.getctime(file))
# fiels = files.reverse()
i = 1;
advanced = "advanced"
for file in files:
	f_name, f_ext = os.path.splitext(file)
	# new_name = f'{advanced.capitalize()}-{i}-{f_name}'
	# new_name = f'{f_name}( Part {i}/{len(files)} ){f_ext}'
	
	print(new_name)
	i +=1
	# os.rename(file, new_name)
	# print("{} - {}".format(file, time.ctime(os.path.getctime(file))) )

for f in os.listdir():
	f_name, f_ext = os.path.splitext(f)
	# if( f_name != 'rename' ):
		# print(f_name)
		# f_space, f_title = os.path.split(f_name)
		# print(f_space)
		# f_title, f_number = f_title.strip().split()
		# f_number = f_number[1:-1].zfill(2)
		# new_name = f'{f_number}-{f_title}{f_ext}'
		# os.rename(f, new_name)