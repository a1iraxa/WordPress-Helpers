
import sys
import os
import datetime
import calendar
# import antigravity
# add custom path in python search packages
sys.path.append('D:\web-scraping\python tutorials\modules')

# Import all methods and variables
import find_index_module as module
# call like this: module.find_index(courses, 'listory')

# Import speacific method only
from find_index_module import find_index, name
# call directly anywhere: find_index(courses, 'listory')
# also use shortcut as
# from find_index_module import find_index as fi, name
# call like new shortcut: fi(courses, 'listory')

# Import everything
# from find_index_module import *

courses = ['Maths', 'History', 'ComSci']

index = find_index(courses, 'History')
# print(index)

# print('System path for packages loading using sys Library')
# print(sys.path)

# print('Today date by using datetime Library')
# print( datetime.date.today() )

# print('Is leap year by using calendar Library')
# print( calendar.isleap(2017) )

# print('Current working Directoy by using OS Library')
# print( os.getcwd() )

print('file location by using OS Library')
print( os.__file__ )