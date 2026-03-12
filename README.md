Склонируйте репозиторий, 
Установите зависимости с помощью `composer install` и `npm install`. 
затем создайте новую базу данных (например, `laravel_app`) и укажите её параметры подключения в `.env` в полях `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`. 
Сгенерируйте ключ приложения командой `php artisan key:generate`, 
выполните миграции `php artisan migrate`, 

Запуск:
(reverb)
php artisan reverb:start
(vite)
npm run dev 
(очереди)
php artisan queue:flush
php artisan queue:work
(сервер)
php artisan serve
http://127.0.0.1:8000.
