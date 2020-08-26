.SILENT:

all:
	composer install --no-dev -o
	echo
	echo "=============================="
	echo "| ALLER SUR VOTRE NAVIGATEUR |"
	echo "|   http://localhost:8000    |"
	echo "=============================="
	echo
	php -S localhost:8000 -t public
