import urllib.request
import re
from urllib.parse import urlparse, parse_qs
from bs4 import BeautifulSoup as soup



my_url = 'https://www.indiamp3.com/junoon-azadi-mp3-songs'
req = urllib.request.Request(my_url, headers={'User-Agent': 'Mozilla/5.0'})
page_html = urllib.request.urlopen(req).read()



# uClient = uReq(my_url, headers={'User-Agent': 'Mozilla/5.0'})
# page_html = uClient.read()
# uClient.close()
# print(html)

page_souped = soup(page_html, "html.parser")
td_tags = page_souped.find_all('td', style = re.compile('text-align: right'))

filename = "junoon-azadi-mp3-list.txt"
f = open(filename, 'w')

counter = 1


for tag in td_tags:
	mp3_url = tag.a['href']
	url = "https://www.indiamp3.com/" + mp3_url
	parsed = urlparse(url)
	song_id = parse_qs(parsed.query)['song']
	final_url = 'https://www.indiamp3.com/download.php?song_id=' + song_id[0]

	print("Writting into file...")
	f.write( final_url + "\n")
	print("Downloading file...")
	# Download the file from `url` and save it locally under `file_name`:
	req = urllib.request.Request(final_url, headers={'User-Agent': 'Mozilla/5.0'})
	# file = urllib.request.urlopen(req).read()
	# print(file)
	file_name = "Track-"+ str (counter)+".mp3"
	with urllib.request.urlopen(req) as response, open(file_name, 'wb') as out_file:
	    data = response.read() # a `bytes` object
	    out_file.write(data)
	counter = counter + 1
	print( counter, "Track is 100%")
	print('\n\n')


# 	print("Getting Url from main page.")
# 	url = tag['href']

# 	print("Requesting song page.")
# 	songPage = uReq(url)
# 	song_page_html = songPage.read()
# 	songPage.close()
# 	print("Reading song page.")
# 	song_soup = soup(song_page_html, "html.parser")
# 	print("Getting song url.")
# 	span = song_soup.find('span', style = re.compile('text-decoration: underline'))
# 	if span is None:
# 		print("len(span)")
# 	else:
# 		print('YES');
# 		# mp3_url = span.a['href']
# 		mp3_url = span.a

# 		f.write(mp3_url + "\n")
# 		print("Writting into file.")
# 		counter = counter + 1
# 		print('\n\n')
# 		print( counter, "Track is 100%")
# 		print('\n\n')

f.close()