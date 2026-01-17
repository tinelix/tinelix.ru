from django.shortcuts import render
from datetime import datetime

from tinelix_ru.pages.layouts import *

def index(request):
	header = PageHeader()

	links = header.render_links()
	charset = "Windows-1251"
	current_dt = datetime.now()	

	ctx = {	
		"charset": 	charset,
		"links":   	links,
		"current_dt":	current_dt
	      }
	return render(request, "home.html", ctx)
