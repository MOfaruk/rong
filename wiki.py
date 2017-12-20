import urllib3
from BeautifulSoup import BeautifulSoup
import json
import sys

url = 'https://en.wikipedia.org/wiki/'+sys.argv[]

http = urllib3.PoolManager()
response = http.request('GET', url)
soup = BeautifulSoup(response.data.decode('utf-8'))

result = []

list = soup.findAll(["h2", "p"])
hd = soup.find('h1').getText()
ovr = soup.find("p").getText()

tmp = {}
tmp['title'] = hd;
tmp['p'] = ovr
result.append(tmp)

desc = ''
flg = 0

for text in list:
	if(text.name == 'h2' or text.name == 'h1' ):
		if(flg):
			dic = {}
			dic['title'] = title
			dic['p'] = desc
			result.append(dic)

		title = text.getText()
		desc = ''
		flg += 1
	else:
		desc = desc + text.getText()

    #print(text.getText().encode('utf-8'))
    #print('<br>')
print(json.dumps(result))