import codecs

from django.shortcuts import render
from datetime import datetime

from tinelix_ru.pages.layouts import *

class SearchMachine:
	
	def index(self, request):
		header = PageHeader()

		links = header.render_links()
		charset = "Windows-1251"
		current_dt = datetime.now()	

		ctx = {	
			"charset": 	charset,
			"links":   	links,
			"current_dt":	current_dt,
			"weather": {
				"city": "с. Камыши",
				"region": "ННР, Алтайский край",
				"temp": "-15°"
			},
			"newsfeed": [
					{
						"title": "Заголовок 1",
						"summary": "Краткое описание",
						"link": "http://tinelix.ru",
						"timestamp": "2025-12-31 23:59",
						"source": "Tinelix"
		  			},
					{
						"title": "Заголовок 2",
						"summary": "Краткое описание",
						"link": "http://tinelix.ru",
						"timestamp": "2026-01-01 00:00",
						"source": "Tinelix"
					}
      			    	     ],
	      		"holidays": [
		
	      		],
			"static_dir": "../"
		}

		response = render(request, "search.html", ctx)
		response['Content-Type'] = "text/html; charset=" + charset
		response.content = response.content.decode("utf-8").encode(charset)

		return response
