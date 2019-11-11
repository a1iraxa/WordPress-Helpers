from urllib.request import urlopen as uReq
from bs4 import BeautifulSoup as soup
import re

my_url = 'http://www.thesufi.com/sufimusic/nusrat-fateh-ali-khan.html'

uClient = uReq(my_url)
page_html = uClient.read()
uClient.close()

page_soup = soup(page_html, "html.parser")
a_tags = page_soup.article.findAll('a')

filename = "nusrat-fateh-ali-khan.txt"
f = open(filename, 'w')

counter = 1

for tag in a_tags:
	print("Getting Url from main page.")
	url = tag['href']

	print("Requesting song page.")
	songPage = uReq(url)
	song_page_html = songPage.read()
	songPage.close()
	print("Reading song page.")
	song_soup = soup(song_page_html, "html.parser")
	print("Getting song url.")
	span = song_soup.find('span', style = re.compile('text-decoration: underline'))
	if span is None:
		print("len(span)")
	else:
		print('YES')
		# mp3_url = span.a['href']
		mp3_url = span.a

		f.write(mp3_url + "\n")
		print("Writting into file.")
		counter = counter + 1
		print('\n\n')
		print( counter, "Track is 100%")
		print('\n\n')

f.close()