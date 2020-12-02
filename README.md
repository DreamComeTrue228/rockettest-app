Необходимо реализовать страницу товаров с возможностью покупки в двух валютах рубли/тенге.

Сущности реализации:
Категории товара Товары - наличие на складе, уникальный номер товара Курсы валют История платежей

Настройте интеграцию курса валют с нац банка https://nationalbank.kz/rss/rates_all.xml. Реализовать cron команду для
обновление валют. Добавьте платежную систему в тестовом режиме https://developers.cloudpayments.ru/
Залейте задание в любой репозиторий git. Максимально опишите проект / инструкцию к развертке в файле README. Выложите
проект на VPS или бесплатный хостинг сервис, например heroku.

Технологии, которые мы используем в работе:
Верстка – Html, Css, Javascript Бэкенд — Php (Yii2 или Laravel)


------------------------------------------------------------

#1. Установить зависимости :
   composer install && npm install && npm run dev

#2. Создать .env файл и установить переменные в нем
   * 2.1. Создать .env файл в root директории и скопировать в него содержимое файла .env.example
   * 2.2 Создать подключение к базе данных
       * 2.2.1 Сгенерировать APP_KEY (php artisan --no-ansi key:generate --show)
       * 2.2.2 DB_CONNECTION=mysql -- указать тип базы данных { mysql, pgsql }
       * 2.2.3 DB_HOST=127.0.0.1 -- хост базы данных
       * 2.2.4 DB_PORT=3306 -- порт базы данных
       * 2.2.5 DB_DATABASE=db_name -- название базы данных
       * 2.2.6 DB_USERNAME=username -- username
       * 2.2.7 DB_PASSWORD=password -- пароль 
   * 2.3 CP_PUBLIC_ID -публичный ключ cloudpayments для сайта
   * 2.4 APP_URL - url текущего сайта 
        Локально запускается сервер командой php artisan serve --port={8080 - указывается номер порта}
        и относительно сервера установить переменную APP_URL    
   * 2.5 QUEUE_CONNECTION=database --тип подключения очередей 

#3. Запуск миграций и сидеров
    php artisan migrate 
    php artisan db:seed 

#4. Запуск очередей   
    php artisan queue:work --queue={payments - название очереди} --daemon
    php artisan queue:work --queue=currencies --daemon
#5. Запуск планировщика задач
    crontab -e вставить задачу в конец файла
    * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
