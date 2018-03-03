1) Создать приложение twitter app
2) Заполнить в env
TWITTER_ACCESS_TOKEN
TWITTER_ACCESS_TOKEN_SECRET
TWITTER_CONSUMER_KEY
TWITTER_CONSUMER_SECRET

QUEUE_DRIVER=database

3) Заполнить в `config/laravel-twitter-streaming-api.php` хештеги
```php
<?php
    'hash' => [
        '#bgs',
        '#bgsgroup',
    ]
```

4) composer install
5) php artisan migrate:refresh --seed
6) `/login` для менеджера (кто модерирует твиты)

* email: manager@manager.com
* password: secret

Модерация коммитов на главной


Также есть роли, назначешь роль менеджера для юзера он видит 