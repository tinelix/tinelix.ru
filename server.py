from waitress import serve
from tinelix_ru.wsgi import application

if __name__ == '__main__':
	serve(application, listen='127.0.0.1:8000')