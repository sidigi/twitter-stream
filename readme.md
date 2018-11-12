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
5) `php artisan migrate:refresh --seed` (база данных должна поддерживать emoji)
6) `php artisan shedule:run` - запуск задач из командной строки или `* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1` - на крон
`php artisan shedule:run &` - запуск в фоне 
7) `/login` для менеджера (кто модерирует твиты)

* email: manager@manager.com
* password: secret

Также есть роли, назначешь роль менеджера для юзера он видит страницу модерации

8) Модерация коммитов на главной / просмотр там же

Памятка по работе с процессами:
* `php artisan shedule:run &` - запуск в фоне
* `jobs` или `jobs -l` - список процессов 
* `jobs -p` - спискок PID
* `kill -9 [PID]` - убить процесс



/vendor/fennb/phirehose/lib/Phirehose.php
```php
  protected $followIds = [];
  protected $locationBoxes = [];
```

Доп.опции:
`/custom-tweet/save/{id}`
ссылка для добавления твита вручную, где  {id} - это уникальный идентификатор твита.
