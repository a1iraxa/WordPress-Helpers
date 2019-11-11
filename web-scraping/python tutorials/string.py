# Welcome message
call = 'hey'
name = 'python'
body = 'welcome to my world'

# Replace word from string
# message = message.replace('Python', 'Ali')

# String cancatination before 3.6
# message = '{} {}, {}'.format(call.capitalize(), name.capitalize(), body)

# String cancatination after 3.6 or later
message = f'{call.capitalize()} {name.upper()}, {body.capitalize()}'

# To show all appilicable funtions
# print(dir(message))
# print(help(str))



print(message)
