from django.conf import settings
import pytz

class PageHeader:
	def __init__(self):
		self.tz = pytz.timezone(settings.TIME_ZONE)
	
	def render_links(self):
		links = [
			{
				"name": "IRC-чат",
				"url":	"http://irc.tinelix.ru",
				"width": 62
			},
			{
				"name": "Музыка",
				"url":  "http://music.tinelix.ru",
				"width": 70
			},
			{
				"name": "Фотографии",
				"url": 	"http://photos.tinelix.ru",
				"width": 90
			},
			{
				"name": "Блог",
				"url":	"http://blog.tinelix.ru",
				"width": 50
			},
			{
				"name": "Настройки",
				"url": "http://tune.tinelix.ru",
				"width": 82
			}
		]
		return links
