from bs4 import BeautifulSoup as soup
from urllib.request import Request, urlopen
import re
import webbrowser

url = "https://www.google.com.pk/search?rlz=1C1CHBD_enPK730PK730&ei=8EL5Wbm1KamOgAa9mYjoDg&q=how+to+reset+facebook+account+password&oq=how+to+reset+facebook+account+&gs_l=psy-ab.3.0.0l8.852.852.0.2295.1.1.0.0.0.0.565.565.5-1.1.0....0...1.1.64.psy-ab..0.1.564....0.HKJ4EMlVgl0"
regex = '<h3 class="r">(.+?)</h3>'
pattern = re.compile(regex)
request = Request(url, headers={'User-Agent': 'Mozilla/5.0'})
response = urlopen(request)
html_page = response.read()

page_soup = soup(html_page, "html.parser")
anchors_wrapers = page_soup.findAll("h3", { "class" : "r" })

anchors = ""
link_txt = list()
for a in anchors_wrapers:
	anchors = a.findAll('a', href=True)
	for link in anchors:
		link_txt.append('https://www.google.com.pk'+link['href'])
		# print(link_txt, '\n')


print(link_txt[0], '\n')

# Open URL in a new tab, if a browser window is already open.
# webbrowser.open_new_tab(link_txt[0] + 'doc/')