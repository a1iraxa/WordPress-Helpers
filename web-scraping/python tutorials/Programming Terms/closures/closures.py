def html_tag(tag):
	def wrap_html(content):
		print( f'<{tag}>{content}</{tag}>')
	return wrap_html

# h1 tag
# get_h1 = html_tag('h1')
# get_h1('This will print in h1')
# get_h1('Another string will print in h1')


# p tag
# get_p = html_tag('p')
# get_p('This will print in p')
# get_p('Another string will print in p')


