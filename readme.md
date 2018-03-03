`git clone git@github.com:SidiGi/twitter-stream.git`

1) Создать приложение twitter app
2) Заполнить в env:

* TWITTER_ACCESS_TOKEN
* TWITTER_ACCESS_TOKEN_SECRET
* TWITTER_CONSUMER_KEY
* TWITTER_CONSUMER_SECRET
* QUEUE_DRIVER=database

3) Заполнить в `config/laravel-twitter-streaming-api.php` хештеги
```php
    'hash' => [
        '#bgs',
        '#bgsgroup',
    ]
```

4) `composer install`
5) `php artisan migrate:refresh --seed`
6) `php artisan shedule:run` - запуск задач из командной строки или `* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1` - на крон
* !!! Не запускать несколько процессов
* !!! Не останавливать процесс через `Ctrl+C` (это вырубить задачу, но не вырубит занятый connection - поможет или ребут сервера или вручную снятие соединения - не знаю как это делать руками). 
7) `/login` для менеджера (кто модерирует твиты)

* email: manager@manager.com
* password: secret

Также есть роли, назначешь роль менеджера для юзера он видит страницу модерации

8) Модерация коммитов на главной / просмотр там же

