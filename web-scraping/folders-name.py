import os


root, dirs, files = next(os.walk("D:/xampp/htdocs/alpha_wp/wp-content/plugins", topdown=True))
# print (dirs)
filename = "plugins.txt"
f = open(filename, 'w')
for name in dirs:
	f.write(name + "\n")
	print(name + ' writing...' ) 
	
f.close()


directory_list = list()



# print(os.walk("D:/xampp/htdocs/alpha_wp/wp-content/plugins"))

# for root, dirs, files in os.walk("D:/xampp/htdocs/alpha_wp/wp-content/plugins", topdown=True):
    # for name in dirs:
        # directory_list.append( os.path.join(root, name) + "\n" )
    #     f.write(name + "\n")
    #     print(name + ' writing...' ) 
    # f.close()

# print(directory_list)


