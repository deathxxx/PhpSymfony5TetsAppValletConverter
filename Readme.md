#Install

сначала лучше запустить контейнер и выполнять все настройки внутри контейнера (fpm)

composer install

edit .env file 
example
DATABASE_URL="mysql://testapp:testapp@172.16.3.6:45241/testapp?serverVersion=mariadb-10.4.11"

ip - указывается ип локальной машины - так как порты все переносятся на локальную

далее выполняем миграцию
php ./bin/console doctrine:migrations:migrate


#вызов комманд апи
получает и сохраняет курсы для конвертации (хранит единомоментно - обновляется при каждом хапросе)
http://0.0.0.0:5634/api/get/wallets

сам методо вызова сравнения (берет актуальный курс и сравнивает его)
http://0.0.0.0:5634/api/compare/wallet/RUB/1/USD