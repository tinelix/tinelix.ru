from django.conf import settings
import pytz

class PageHeader:
	def __init__(self):
		self.tz = pytz.timezone(settings.TIME_ZONE)
	
	def render_links(self):
		links = [
			{
				"name": "IRC-чат",
				"url":	"http://irc.tinelix.ru"
			},
			{
				"name": "Музыка",
				"url":  "http://music.tinelix.ru"
			},
			{
				"name": "Фотографии",
				"url": 	"http://photos.tinelix.ru",
			},
			{
				"name": "Блог",
				"url":	"http://blog.tinelix.ru"
			},
			{
				"name": "Ретро-веб",
				"url": "http://retroweb.tinelix.ru"
			}
		]
		return links
