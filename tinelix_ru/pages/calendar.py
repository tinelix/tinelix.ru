import codecs

from django.shortcuts import render
from datetime import datetime
from calendar import monthrange

from tinelix_ru.pages.layouts import *

class WebCalendar:
	
	def index(self, request):
		header = PageHeader()

		links = header.render_links()
		charset = "Windows-1251"
		current_dt = datetime.now()	
		calendar_table = self.createCalendarTable(current_dt);

		ctx = {	
			"charset": 	charset,
			"links":   	links,
			"current_dt":	current_dt,
			"holidays": [
				
	      		],
			"calendar_table": calendar_table,
			"static_dir": "../"
		}

		response = render(request, "calendar.html", ctx)
		response['Content-Type'] = "text/html; charset=" + charset
		response.content = response.content.decode("utf-8").encode(charset)

		return response

	def createCalendarTable(self, dt):
		table = """<TABLE cellpadding="2" cellspacing="0">""";
		
		max_days = monthrange(dt.year, dt.month)[1]
		first_day = datetime(dt.year, dt.month, 1)

		if first_day.weekday() > 0:
			max_weeks = round(max_days / 7) + 1
		else:
			max_weeks = round(max_days / 7)

		for x in range(7):
			table += '<TR>'
			for y in range(max_weeks):
				
				short_weekday_name = ""
				day_number = (x + 1 - first_day.weekday()) + (7 * y)
				
				if y == 0:
					match x:
						case 0:
							table += "<TH>Пн</TH>"
						case 1:
							table += "<TH>Вт</TH>"
						case 2:
							table += "<TH>Ср</TH>"
						case 3:
							table += "<TH>Чт</TH>"
						case 4:
							table += "<TH>Пт</TH>"
						case 5:
							table += "<TH>Сб</TH>"
						case _:
							table += "<TH>Вс</TH>"

				if day_number <= 0 or day_number > max_days:
					table += f'<TD align="right"></TD>'
				elif dt.day == day_number:
					table += f'<TD align="right" bgcolor="#00ffff"><font color="#000000"><B>{day_number}</B>&nbsp;</FONT></TD>'
				else:
					table += f'<TD align="right">&nbsp;{day_number}&nbsp;</TD>'

			table += '</TR>'

		table += "</TABLE>"

		return table
