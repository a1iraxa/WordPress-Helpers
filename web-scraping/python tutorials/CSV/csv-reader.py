import csv

# with open('data.csv', 'r') as csv_file:
# 	csv_reader = csv.reader(csv_file)

# 	# start form 2nd line ignoring main heading
# 	# next(csv_reader) 

# 	with open('names.csv', 'w') as names_file:
# 		csv_writer = csv.writer(names_file, delimiter='\t')
# 		for line in csv_reader:
# 			csv_writer.writerow(line)

# # Read new created file seprated by tab
# with open('names.csv', 'r') as tab_separated_file:
# 	tab_separated_reader = csv.reader(tab_separated_file, delimiter='\t')
# 	for line in tab_separated_reader:
# 		print(line)


with open('data.csv', 'r') as csv_file:
	csv_reader = csv.DictReader(csv_file)

	with open('names_by_dict.csv', 'w') as new_names_file:
		fieldnames = ['first_name', 'last_name']
		csv_writer = csv.DictWriter(new_names_file, fieldnames=fieldnames, delimiter='\t')

		csv_writer.writeheader()

		for line in csv_reader:
			del line['email']
			csv_writer.writerow(line)