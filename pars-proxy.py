import requests
from bs4 import BeautifulSoup
from random import choice
import time

#A simple Python module to bypass Cloudflare's anti-bot page 
#(also known as "I'm Under Attack Mode", or IUAM), implemented with Requests.
#https://github.com/Anorov/cloudflare-scrape
import cfscrape

urlProxy = 'https://hidemyna.me/ru/proxy-list/'


def get_html(url):
	scraper = cfscrape.create_scraper()
	r = scraper.get(urlProxy)
	return r.text



def get_ip(html):
	soup = BeautifulSoup(html, 'lxml')
	table = soup.find('table')
	ip_list = table.find_all('tr')
	i = 1
	file = open('file', 'w')
	while i < 22:
		count_table = ip_list[i]
		listIp = count_table.find_all('td')[0].text
		listPort = count_table.find_all('td')[1].text
		file.write(listIp + ':' + listPort + '\n')
		i +=1
	file.close()

def main():
	while True:
		html = get_html(urlProxy)
		get_ip(html)
		time.sleep(36)

if __name__ == '__main__':
	main()
