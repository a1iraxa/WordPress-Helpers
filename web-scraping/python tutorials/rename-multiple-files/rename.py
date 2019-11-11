import os

for f in os.listdir():
	f_name, f_ext = os.path.splitext(f)
	if( f_name != 'rename' ):

		f_space, f_title = os.path.split(f_name)
		f_title, f_number = f_title.strip().split()
		f_number = f_number[1:-1].zfill(2)
		new_name = f'{f_number}-{f_title}{f_ext}'
		os.rename(f, new_name)